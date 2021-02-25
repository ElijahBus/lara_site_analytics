# Dashboard Package

The Dashboard Pakcge is a plug-and-play laravel package that provides  a quick and easy integration of a dashboard in your laravel project, with customizable assets built in for **Analytics**, **Users**, **Roles**, **Permissions** and **TOS** management.

## Requirements

Laravel [5.8](https://laravel.com/docs/5.8/) \
Laratrust [5.2](https://laratrust.santigarcor.me/docs/5.2/)


## Installation

Use the php dependency manager, [composer](https://getcomposer.org/), to install the package.

```
composer require rwbuild/dashboard
```

## Setup

Once the installion is complete, run 
```
php artisan dashboard:setup
```
This command will create a migration file in *database > migrations*. Before proceeding run the migrate command first.
```
php artisan migrate
```

## Installation
### 01

Once the migrate command has run successfully, run the command below to get the dashboard installed in your application. 
```
php artisan dashboard:install
```
then,
```
php artisan migrate
```

### 02
After successfully running this command, your folders structure should change and looks like:

Inside **app>Http>Controllers** , a **Dashboard** folder containing controller files will be created.

Inside **app>Http>View>Composers** will be generated view composer files that powers the blade views.

A Helper class will also be generated inside **app>Helpers** where you put your helper funtions for personal customizations.

Inside **resources>views** , a **dashboard** folder containing blade files will be created. These are customizable views that power the dashboard.

Inside **routes/web.php** and **api.php**, the files will be updated with the dashboard routes, and should look like this:
```php
...
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function () {
    ...
});

```

Inside the **public>css** folder, you should have the **dashboard.css** file, that contains all sylings of the dashboard.

Inside the **pubic>js** folder, you should have the **dashboard.js** and **dashboard_analytics.js** fils.

### 03

Load the view composers class in **AppServiceProvider.php**

```php
use App\Http\View\Composers\Dashboard\ { 
    TosComposer,
    HomeComposer,
    UsersComposer,
    RolesComposer,
    ReportsComposer,
    PermissionsComposer
};
...
   public function boot()
    {
        View::composer('dashboard::assets.home', HomeComposer::class);
        View::composer('dashboard::assets.users', UsersComposer::class);
        View::composer('dashboard::assets.roles', RolesComposer::class);
        View::composer('dashboard::assets.permissions', PermissionsComposer::class);
        View::composer('dashboard::assets.tos', TosComposer::class);
        View::composer('dashboard::assets.reports', ReportsComposer::class);
    }
```

### 04

Add the helper file in composer.json
```php
...
"files": [
    "app/Helpers/DashboardHelpers.php"
]
...

Then run composer dump-autoload
```

### 05
Go to **app>Http>Kernel.php** and add a midlleware to your _$routeMiddleware_ array
```php
...
'visit.log' => \Dashboard\Http\Middlewares\LogVisit::class
```

You should add this middleware to your web routes to get the users' on visits on your site logged.

Inside your main layout, or your entry file, include the **dashboard_analytics.js** file,

```html
    <script src="{{ asset('js/dashboard_analytics.js') }}"></script>
```

- Features visits

    To get the analytics of **hits** or features your users visited, call the fuction **daFeatureVisit(featureName)** on your target event:

    eg.
    ```js
        onclick="daFeatureVisit('apply')"
    ```




## Configurations

To get the package working perfecly, check if the configurations are set properly. Inside the *config* folder, you should find the **dashboardmodels.php** that contains the configuration of your application models. This tell the package where to look for the models. Configure each key according to the namespace of the model its point to.

```bash
At this point, you should be able to navigate to /dashboard and get it working. 
```
## Deep dive

### Accessing models inside the package's controllers

All action on models can be perfomed inside the dashboard controllers by:

#### Using the Model facade
```php
...
use Dashboard\Facades\Model;
...

public function index()
{
    return Model::user()::all();
}
...
```

#### Using the ModelsDefinition trait
```php
...
use ModelsDefinition;

public function show()
{
    return $this->user::findOrFail(1);
}
...
```


**Have fun** 😎 
## License
[MIT](https://choosealicense.com/licenses/mit/)
