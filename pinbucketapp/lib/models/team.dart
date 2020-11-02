

import 'package:flutter/material.dart';
import 'package:pinbucketapp/models/link.dart';

class Team{

  final int id;
  final String name;
  final List<Link> links;

  Team({
    @required this.id,
    @required this.name,
    this.links
  });

  factory Team.fromJson(Map<String, dynamic> json) {

    final links = json['links'].cast<Map<String, dynamic>>();

    return Team(
      id: json['id'],
      name: json['name'],
      links: new List<Link>.from(links.map((j) => Link.fromJson(j)))
    );
  }

}
