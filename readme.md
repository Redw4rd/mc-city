# Pixelhero Minecraft website

Pixelhero is a minecraft themed community. I enjoyed the work of this site, with my friend, who wrote the desktop app. 

The hard part was: 
I never wrote a paypal integration before on any website that I make. I worked from the paypal api documentation and as you can see **its just works!** The other coding challenge was the SMS purchase integration, but the provider also have a poor api so it's a bit lame.

[>> You can find the active page here <<](https://pixelhero.hu)

## I worked with

* Bootstrap 3 ([Bootstrap website](https://getbootstrap.com))
* Laravel ([Laravel website](http://laravel.com))
* Paypal ([Paypal dev](https://developer.paypal.com/docs/api/overview/))
* SMS provider ([Info-tech Bt.](http://info-tech.hu))
* Rcon server handler from valve (I never used it, but tested it's functionality so I left in the code :|)

## Verdict

Good | Bad
------------ | -------------
It's a working website | The e-commerce system is poor (only few product)
It has User manager, Ticket system, E-commerce system | No extra single page ability, just what is in the database hardcoded
 - | It's still buggy
 - | SQL migration does not work. (Fly away with site error code, because of migration :()
 - | Dropped project

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
