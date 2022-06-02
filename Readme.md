# CisTableBuilder
###### Table Builder for Laravel with CisFoundation

## Usage

###### Load some data you want to show in a table view
```
$users = User::all();
```
###### Initialize your table
```
$table = CisTableBuilder::table('users');
```
###### Set the CSS class for the table
```
$table->setCssClass('my-css-class');
```
###### Set the data for the table
```
$table->setData($users);
```
###### Set the field names for the table
```
$table->setFields([
    'id' => 'ID',
    'username' => 'Username',
]);
```
###### Set some action links for the the actions row
```
$table->addAction('ändern',"modules.show",['name' => 'func:getName']);
```


$table->addAction('ändern',"modules.show",['name' => 'func:getName']);
$table->addAction('löschen',"modules.show",['name' => 'func:getName'],'post');
```
