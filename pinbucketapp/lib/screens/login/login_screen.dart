import 'package:flutter/material.dart';
import 'package:pinbucketapp/api.dart';
import 'package:pinbucketapp/cache.dart';
import 'package:pinbucketapp/constants.dart';
import 'package:pinbucketapp/screens/home/home_sceen.dart';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

final storage = new FlutterSecureStorage();
final api = new Api(storage: storage, cache: new Cache());

class LoginScreen extends StatelessWidget {
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();

  void displayDialog(context, title, text) => showDialog(
        context: context,
        builder: (context) =>
            AlertDialog(title: Text(title), content: Text(text)),
      );

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        child: Column(children: [
          SingleChildScrollView(
            child: Column(
              children: [
                Header(),
                Padding(
                  padding: EdgeInsets.symmetric(horizontal: 30),
                  child: Column(
                    children: [
                      SizedBox(height: 30),
                      Container(
                        decoration: BoxDecoration(),
                        child: TextFormField(
                          textInputAction: TextInputAction.next,
                          controller: _emailController,
                          keyboardType: TextInputType.emailAddress,
                          decoration: InputDecoration(
                            labelText: 'Email',
                            hintText: 'john.doe@mail.com',
                            border: OutlineInputBorder(),
                          ),
                        ),
                      ),
                      SizedBox(height: 30),
                      TextFormField(
                        textInputAction: TextInputAction.go,
                        obscureText: true,
                        controller: _passwordController,
                        decoration: InputDecoration(
                          labelText: 'Password',
                          border: OutlineInputBorder(),
                        ),
                      ),
                      SizedBox(height: 30),
                      SizedBox(
                        width: double.infinity,
                        child: RaisedButton(
                          child: Padding(
                            padding: const EdgeInsets.all(20.0),
                            child:
                                Text("Login", style: TextStyle(fontSize: 18)),
                          ),
                          color: kSecondaryColor,
                          onPressed: () async {
                            var email = _emailController.text;
                            var password = _passwordController.text;

                            if (email.length == 0 || password.length == 0) {
                              return;
                            }

                            storage.deleteAll();
                            var user = await api.login(email, password);
                            if (user != null) {
                              storage.write(key: 'token', value: user.apiToken);
                              Navigator.pushReplacement(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => HomeScreen(),
                                  ));
                            } else {
                              displayDialog(context, "An Error Occurred",
                                  "No account was found matching that username and password");
                            }
                          },
                          textColor: Colors.white,
                          padding: EdgeInsets.symmetric(horizontal: 50),
                        ),
                      ),
                      SizedBox(height: 15),
                      // Text("No account yet ?"),
                      // SizedBox(height: 15),
                      // SizedBox(
                      //   width: double.infinity,
                      //   child: RaisedButton(
                      //     child: Padding(
                      //       padding: const EdgeInsets.all(10.0),
                      //       child: Text("Register",
                      //           style: TextStyle(fontSize: 18)),
                      //     ),
                      //     color: kSecondaryColor,
                      //     onPressed: () {},
                      //     textColor: Colors.white,
                      //     padding: EdgeInsets.symmetric(horizontal: 50),
                      //   ),
                      // ),
                      // SizedBox(height: 30),
                    ],
                  ),
                )
              ],
            ),
          ),
          Spacer(),
          Footer(),
        ]),
      ),
    );
  }
}

class Header extends StatelessWidget {
  const Header({
    Key key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(color: kPrimaryColor),
      height: 150,
      child: Padding(
        padding: const EdgeInsets.only(top: 20),
        child: Center(
          child: Text("PinBucket.io", style: kHeadingStyle),
        ),
      ),
    );
  }
}

class Footer extends StatelessWidget {
  const Footer({
    Key key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(color: kRowBackgroundColor),
      child: Padding(
          padding: const EdgeInsets.all(10.0),
          child: Center(
            child: RichText(
              text: TextSpan(
                children: [
                  TextSpan(
                      text: "Made with ",
                      style: TextStyle(color: Colors.black54)),
                  WidgetSpan(
                    child: Icon(Icons.favorite, size: 14, color: Colors.red),
                  ),
                  TextSpan(
                      text: " by aschelch",
                      style: TextStyle(color: Colors.black54)),
                ],
              ),
            ),
          )),
    );
  }
}
