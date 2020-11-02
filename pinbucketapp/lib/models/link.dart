

import 'package:flutter/material.dart';
import 'package:pinbucketapp/models/user.dart';

class Link{

  final int id;
  final String title, description;
  final String url;
  final String preview;
  final User user;

  Link({
    @required this.id,
    @required this.title,
    @required this.description,
    @required this.url,
    @required this.preview,
    this.user,
  });

  factory Link.fromJson(Map<String, dynamic> json) {
    return Link(
      id: json['id'],
      title: json['title'],
      description: json['description'],
      url: json['url'],
      preview: json['preview'].substring(23)
    );
  }

}
