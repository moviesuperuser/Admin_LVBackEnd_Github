# Admin_LVBackEnd_Github

### API Comment:

1. showCommentFlagList: \
   `/api/comment/showCommentFlagList` : GET method
2. deleteFlagComment: \
   `/api/comment/deleteFlagComment/{IdComment}` : GET method

3. disableFlagAction: \
   `/api/comment/disableFlagAction` : POST method \
   Required post `request` parameters `IdComment`,`IdUser`\
   Parameters in `request`

```php
        'IdComment' => 'required|numeric',
        'IdUser'    => 'required|numeric'
```
### API LiveStream:

1. showLiveStreamList: \
   `/api/livestream/showLiveStreamList` : GET method

2. addLivestream: \
   `/api/livestream/addLivestream` : POST method \
   Required post `request` parameters `Title`,`Link`,`Start_time`,`Genres`\
   Parameters in `request`

```php
        "Title" => 'required|string',
        "Link" => 'required|string',
        "Start_time" => 'required|date',
        "Genres" => 'required|string',
```
2. editLivestream: \
   `/api/livestream/editLivestream` : POST method \
   Required post `request` parameters `LivestreamId`,`Title`,`Link`,`Start_time`,`Genres`\
   Parameters in `request`

```php
        "LivestreamId" => 'required|numeric',
        "Title" => 'required|string',
        "Link" => 'required|string',
        "Start_time" => 'required|date',
        "Genres" => 'required|string',
```
2. addLivestream: \
   `/api/livestream/deleteLivestream/{LivestreamId}` : GET method \

