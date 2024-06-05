---
title: Share a link
---
<SwmSnippet path="/app/Http/Controllers/LinksController.php" line="19">

---

&nbsp;

```hack
  public function create(Request $request)
  {

    $team = Team::find($request->team_id);
    if( ! $team->users->contains(Auth::id())){
      return redirect()->back();
    }
```

---

</SwmSnippet>

<SwmMeta version="3.0.0" repo-id="Z2l0aHViJTNBJTNBcGluYnVja2V0LmlvJTNBJTNBYXNjaGVsY2g=" repo-name="pinbucket.io"><sup>Powered by [Swimm](https://app.swimm.io/)</sup></SwmMeta>
