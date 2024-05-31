## ProcessOldLink Command Documentation 

**Table of Contents**

* [Overview](#overview)
* [Usage](#usage)
* [Implementation Details](#implementation-details)


### Overview <a name="overview"></a> 

This command processes old links without preview. It iterates over all links in the database that have a null preview value and dispatches a `ProcessLink` job for each link.

### Usage <a name="usage"></a> 

To run the command, use the following command:

```bash
php artisan link:old
```

### Implementation Details <a name="implementation-details"></a> 

####  `ProcessOldLink` Command Class

| Attribute | Description |
|---|---|
| `$signature` |  The command signature, which is "link:old". |
| `$description` | The command description, which is "Process old link without preview". |

#### `handle()` method

* Retrieves all links from the database where the `preview` field is NULL.
* Iterates over each link and dispatches a `ProcessLink` job for it.

```php
    public function handle()
    {
        $links = Link::where('preview', NULL)->get();
        foreach ($links as $link) {
            ProcessLink::dispatch($link);
        }
    }
```

This command assumes that the `ProcessLink` job handles the processing of the link without requiring a preview. 

**Note:** This command should be used carefully as it might be computationally expensive if there are a large number of links without previews. 
