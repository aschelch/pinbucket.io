import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'package:pinbucketapp/constants.dart';
import 'package:pinbucketapp/screens/home/home_sceen.dart';
import 'package:pinbucketapp/screens/login/login_screen.dart';

final storage = new FlutterSecureStorage();

class LandingScreen extends StatefulWidget {
  @override
  LandingScreenState createState() {
    return new LandingScreenState();
  }
}

class LandingScreenState extends State<LandingScreen> {
  var _loggedIn = false;

  @override
  void initState() {
    super.initState();

    new Timer(new Duration(seconds: 2), _redirect);
    storage.read(key: "token").then((token) {
      _loggedIn = token != null;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: BoxDecoration(color: kPrimaryColor),
        child: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Text("PinBucket.io", style: kHeadingStyle),
              Text("Share tech articles with your teammates",
                  style: kSubtitleStyle),
            ],
          ),
        ),
      ),
    );
  }

  void _redirect() {
    if (_loggedIn) {
      print('Redirect to home');
      Navigator.pushReplacement(
          context,
          MaterialPageRoute(
            builder: (context) => HomeScreen(),
          ));
    } else {
      print('Redirect to login');
      Navigator.pushReplacement(
          context,
          MaterialPageRoute(
            builder: (context) => LoginScreen(),
          ));
    }
  }
}
