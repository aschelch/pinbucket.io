
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'package:pinbucketapp/cache.dart';
import 'package:pinbucketapp/models/team.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:pinbucketapp/models/user.dart';

class Api {
  //final String API_URL = "http://10.0.2.2:8080/api"; //for dev
  final String API_URL = "https://www.pinbucket.io/api"; // for prod

  final FlutterSecureStorage storage;
  final Cache cache;

  Api({this.storage, this.cache});

  Future<User> login(email, password) async {
    try {
      final response =
          await http.post('${API_URL}/login', headers: <String, String>{
        'Accept': 'application/json',
      }, body: {
        'email': email,
        'password': password
      });
      if (response.statusCode == 200) {
        return User.fromJson(jsonDecode(response.body));
      }
    } on Exception catch (e) {
      return null;
    }
    return null;
  }

  Future<List<Team>> fetchTeams({bool useCache = true}) async {
    var token = await storage.read(key: "token");
    if (token == null) {
      return Future.error("No token found");
    }

    if(await cache.exists() && useCache) {
      var jsonList = jsonDecode(await cache.read()) as List;
      return jsonList.map((json) => Team.fromJson(json)).toList();
    }

    try {
      final response =
          await http.get('${API_URL}/teams', headers: <String, String>{
        'Accept': 'application/json',
        'Authorization': 'Bearer ${token}',
        'Content-Type': 'application/json; charset=UTF-8',
      });

      if (response.statusCode == 200) {
        print("Loading from api");

        await cache.write(response.body);

        var jsonList = jsonDecode(response.body) as List;
        return jsonList.map((json) => Team.fromJson(json)).toList();
      }

      return Future.error("Not connected");
    } on Exception catch (e) {
      print(e);

      var jsonData = await cache.read();
      if (jsonData != null) {
        var jsonList = jsonDecode(jsonData) as List;
        return jsonList.map((json) => Team.fromJson(json)).toList();
      }

      return Future.error("Impossible to fetch data");
    }
  }
}
