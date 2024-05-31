## LinkPreviewUpdated Event Documentation

### Table of Contents

* [Introduction](#introduction)
* [Event Usage](#event-usage)
    * [Event Attributes](#event-attributes)
    * [Broadcasting Channels](#broadcasting-channels)
    * [Event Dispatching](#event-dispatching)

### Introduction 

This document provides a detailed overview of the `LinkPreviewUpdated` event within the application. This event is triggered when the preview of a link is updated, notifying relevant parties of the change.

### Event Usage 

The `LinkPreviewUpdated` event is designed to facilitate communication between different parts of the application when the preview of a link is modified. It utilizes Laravel's event broadcasting system to notify interested listeners about the update.

#### Event Attributes

The `LinkPreviewUpdated` event carries the following attributes:

| Attribute | Type | Description |
|---|---|---|
| `link_id` | Integer | The ID of the link whose preview was updated. |
| `team_id` | Integer | The ID of the team associated with the link. |

#### Broadcasting Channels

The `LinkPreviewUpdated` event broadcasts on a private channel specific to the team associated with the updated link. This ensures that only users within the relevant team receive the notification.

```php
return new PrivateChannel('team.' . $this->team_id);
```

#### Event Dispatching

To dispatch the `LinkPreviewUpdated` event, use the following code:

```php
// Assume $link_id and $team_id are available variables
event(new LinkPreviewUpdated($link_id, $team_id));
```

This will broadcast the event on the designated private channel, notifying listeners within the team about the updated link preview.
