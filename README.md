
# Laravel Khalti

This Laravel package allows you to create payment using Khalti.


## Usage/Examples
### Install Using Composer
```javascript
composer require dipesh79/laravel-khalti
```

### Add Four Variable in .env
You can get  from Khalti Secret Key from Khalti Merchant Account
```
KHALTI_SECRET_KEY="Khalti Secret Id"
KHALTI_ENV = "Sandbox" or "Live"
KHALTI_WEBSITE="https://yourwebsite.com"
KHALTI_CALLBACK="https://yourwebsite.com/return_ur" // User will be redirected to this url after payment. The payment can be success for fail.
```
### Publish Vendor File
```
php artisan vendor:publish --provider="Dipesh79\LaravelKhalti\KhaltiServiceProvider"
```
or 
```
php artisan vendor:publish
```
And publish "Dipesh79\LaravelKhalti\KhaltiServiceProvider"


Redirect the user to payment page from your controller

```
use Dipesh79\LaravelEsewa\LaravelEsewa;

//Your Controller Method
public function khaltiPayment()
{
    //Store payment details in DB with pending status
    $khalti = new LaravelKhalti();
    $amount = 123; // In Paisa
    $order_id = 251264889; //Your Unique Order Id
    $order_name = "Order Name";
    
    $payment_response = $khalti->khaltiCheckout($amount,$order_id,$order_name);
    
    $pidx = $payment_response['pidx']; //Store this to your db for future reference.
    $url = $payment_response['payment_url'];
    return redirect($url);
}

```

After Successfull Payment khalti will redirect the user to your callback url.

Callback URL (It must be GET Method)
```
public function callBackCase(Request $request)
{
    $order_id = $request->oid;
    $payment = Payment::where('order_id', $order_id)->first();
    $payment->status = "Success";
    $payment->save();

    //Other Tasks
           
}
```



## License

[MIT](https://choosealicense.com/licenses/mit/)


## Author

- [@Dipesh79](https://www.github.com/Dipesh79)


## Support

For support, email dipeshkhanal79@gmail.com.

