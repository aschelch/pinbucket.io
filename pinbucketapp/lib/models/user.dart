import 'package:flutter/material.dart';

class User{

  final int id;
  final String name;
  final String avatar;
  final String email;
  final String apiToken;

  User({
    @required this.id,
    @required this.name,
    this.avatar,
    this.email,
    this.apiToken,
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      id: json['id'],
      name: json['name'],
      email: json['email'],
      apiToken: json['api_token'],
    );
  }

}