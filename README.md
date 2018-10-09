
# PayLabs  
  
Such a good payment gateway (working on Laravel 5.7)  
  
## Installation  
  
`composer require bugradayi/pay-labs`  
  
   you need to add PayLabs\ServiceProvider to your `config/app.php` providers array:  
  
    PayLabs\PayLabsServiceProvider::class 

also need to add PayLabs\Facades to your `config/app.php` aliases array:

    'PayLabs' => PayLabs\Facades\PayLabs::class
    
Finally to register events

    composer dump-autoload -o

  
## Supported Payment Gateways  
  
|        |Payment|Refund|Transfer|Subscription
|--------|-------|-----|----|----|
|TurkPos |`Implemented`|`Coming soon`|`Implemented`  
|Iyzico  |`Coming Soon`| | | `Coming Soon`  
|Garanti  |`Coming Soon`| `-`| `-` 
  
> **Note:** Under developing therefore I don't suggest to use