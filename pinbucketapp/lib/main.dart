import 'package:flutter/material.dart';
import 'package:pinbucketapp/constants.dart';
import 'package:pinbucketapp/screens/landing/landing_screen.dart';


void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  static const String _title = 'PinBucket App';

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
        debugShowCheckedModeBanner: false,
        title: _title,
        theme: ThemeData(
            scaffoldBackgroundColor: kBackgroundColor,
            primaryColor: kPrimaryColor),
        home: LandingScreen()
    );
  }

}
