## LinkPreviewUpdated Event Documentation

### Table of Contents

* [Introduction](#introduction)
* [Event Structure](#event-structure)
* [Event Broadcasting](#event-broadcasting)

### Introduction

This file defines the `LinkPreviewUpdated` event, which is triggered when the preview of a link is updated.

### Event Structure

The `LinkPreviewUpdated` event class is responsible for handling the logic related to a link preview update.

| Property | Type | Description |
|---|---|---|
| `link_id` | `int` | The ID of the link whose preview was updated. |
| `team_id` | `int` | The ID of the team the link belongs to. |

**Constructor:**

```php
public function __construct($link_id, $team_id)
```

The constructor initializes the `link_id` and `team_id` properties with the provided values.

### Event Broadcasting

The `LinkPreviewUpdated` event broadcasts on a private channel specific to the team the link belongs to.

**Broadcast Channel:**

```php
return new PrivateChannel('team.' . $this->team_id);
```

This ensures that only users within the specified team will receive notifications about the link preview update. 

The event broadcasting functionality allows for real-time updates and communication between different parts of the application, enabling a seamless user experience. 
