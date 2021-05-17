# Admin_LVBackEnd_Github

### API Comment:

1. showCommentFlagList: \
   `/api/comment/showCommentFlagList` : GET method
2. deleteFlagComment: \
   `/api/comment/deleteFlagComment` : POST method \
   Required post `request` parameters `IdComment`\
   Parameters in `request`

```php
        'IdComment'     => 'required|numeric'
```

3. disableFlagAction: \
   `/api/comment/disableFlagAction/{IdComment}` : POST method \
 
