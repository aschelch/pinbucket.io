import 'package:flutter/material.dart';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pinbucketapp/api.dart';
import 'package:pinbucketapp/cache.dart';
import 'package:pinbucketapp/models/team.dart';
import 'package:pinbucketapp/screens/login/login_screen.dart';
import 'components/team_tab_controller.dart';

final storage = new FlutterSecureStorage();
final cache = new Cache();
final api = new Api(storage: storage, cache: cache);

class HomeScreen extends StatefulWidget {
  const HomeScreen({
    Key key,
  }) : super(key: key);

  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  Future<List<Team>> futureTeamList;

  @override
  void initState() {
    super.initState();
    futureTeamList = api.fetchTeams();
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder(
        future: futureTeamList,
        builder: (context, snapshot) {
          if (snapshot.hasData) {
            return TeamTabController(teams: snapshot.data, refreshCallback: () {
              futureTeamList = api.fetchTeams(useCache: false);
              setState(() {});
            }, logoutCallback: (){
              cache.delete();
              storage.delete(key: 'token');

              Navigator.pushReplacement(
                context,
                MaterialPageRoute(
                  builder: (context) => LoginScreen(),
                ));

            });
          } else if (snapshot.hasError) {
            
            return null;
          }
          // By default, show a empty state.
          return Scaffold(
              appBar: AppBar(
                title: Text("PinBucket.io"),
              ),
              body: Center(
                child: SvgPicture.asset(
                  "assets/images/team.svg",
                  width: 200,
                ),
              ));
        });
  }
}
