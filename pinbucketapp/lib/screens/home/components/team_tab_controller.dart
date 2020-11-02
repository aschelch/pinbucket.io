import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:pinbucketapp/models/team.dart';
import 'package:pinbucketapp/screens/home/components/link_widget.dart';

import '../../../constants.dart';

class TeamTabController extends StatelessWidget {
  final List<Team> teams;
  final refreshCallback;
  final logoutCallback;

  const TeamTabController(
      {Key key, this.teams, this.refreshCallback, this.logoutCallback})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: teams.length,
      child: Scaffold(
        appBar: AppBar(
          title: Text("PinBucket.io"),
          actions: <Widget>[
            IconButton(
              icon: Icon(Icons.refresh),
              onPressed: refreshCallback,
            ),
            PopupMenuButton(
              onSelected: (value) {
                switch (value) {
                  case 1:
                    logoutCallback();
                    break;
                  default:
                }
              },
              icon: Icon(Icons.more_vert),
              tooltip: 'Account',
              itemBuilder: (context) => [
                
                PopupMenuItem(
                  value: 1,
                  child: Text(
                    'Logout',
                    style: TextStyle(
                      color: Colors.blueGrey,
                    ),
                  ),
                ),
              ],
            ),
          ],
          bottom: PreferredSize(
            preferredSize: Size.fromHeight(50),
            child: Align(
              alignment: Alignment.centerLeft,
              child: TabBar(
                indicator: BoxDecoration(color: kSecondaryColor),
                indicatorColor: kSecondaryColor,
                isScrollable: true,
                tabs: List<Tab>.generate(teams.length, (index) {
                  return new Tab(text: teams[index].name);
                }),
              ),
            ),
          ),
        ),
        body: new TabBarView(
            children: List<Widget>.generate(teams.length, (i) {
          if (teams[i].links != null && teams[i].links.length > 0) {
            return ListView.builder(
                itemCount: teams[i].links.length,
                itemBuilder: (context, j) {
                  return LinkWidget(link: teams[i].links[j], index: j);
                });
          }
          return Center(
            child: SvgPicture.asset(
              "assets/images/bookmarks.svg",
              width: 200,
            ),
          );
        })),
      ),
    );
  }
}
