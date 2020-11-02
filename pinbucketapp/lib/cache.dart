import 'dart:io';

import 'package:path_provider/path_provider.dart';

class Cache {

  final String filename;

  Cache({
    this.filename = 'cache.json'
  });

  write(String json) async {
    var cacheDir = await getTemporaryDirectory();
    File file = new File(cacheDir.path + "/" + filename);
    file.writeAsString(json, flush: true, mode: FileMode.write);
  }

  Future<bool> exists() async {
    var cacheDir = await getTemporaryDirectory();
    return await File(cacheDir.path + "/" + filename).exists();
  }

  Future<String> read() async {
    var cacheDir = await getTemporaryDirectory();
    if (await File(cacheDir.path + "/" + filename).exists()) {
      print("Loading from cache");
      return File(cacheDir.path + "/" + filename).readAsStringSync();
    }
    return null;
  }

  delete() async {
    final cacheDir = await getTemporaryDirectory();
    if (await File(cacheDir.path + "/" + filename).exists()) {
      cacheDir.delete(recursive: true);
      print("Deleting cache");
    }
  }
}
