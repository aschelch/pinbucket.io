import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:pinbucketapp/constants.dart';
import 'package:pinbucketapp/models/link.dart';
import 'package:url_launcher/url_launcher.dart';

class LinkWidget extends StatelessWidget {
  final Link link;
  final int index;

  const LinkWidget({
    Key key,
    @required this.link,
    @required this.index,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsets.symmetric(vertical: 5),
      child: ListTile(
          tileColor: (index % 2 == 0) ? null : kRowBackgroundColor,
          title: Text("${link.title}", overflow: TextOverflow.ellipsis, maxLines: 2,),
          subtitle: Text("${link.description}\n${link.description}", overflow: TextOverflow.ellipsis, maxLines:3,),
          leading: link.preview.isNotEmpty
              ? Image.memory(base64Decode(link.preview), width: 64)
              : Image.memory(base64Decode(defaultPreview), width: 64),
          //trailing: Icon(Icons.more_vert),
          isThreeLine: true,
          onTap: () async {
            if (await canLaunch(link.url)) {
              await launch(link.url);
            } else {
              throw 'Could not launch ${link.url}';
            }
          }),
    );
  }
}

const defaultPreview =
    "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";
