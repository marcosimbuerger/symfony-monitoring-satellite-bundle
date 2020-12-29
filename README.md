# Monitoring Satellite for Symfony 🛰

The Monitoring Satellite provides data about your Symfony application for the Monitoring Station.

## Installation

### Install the bundle
```bash
$ composer require marcosimbuerger/symfony-monitoring-satellite-bundle
```

### Enable the bundle
Check your `config/bundles.php`. The MonitoringSatelliteBundle should have been added automatically. If not, add it manually.

```php
// config/bundles.php

return [
    // ...
    MarcoSimbuerger\MonitoringSatelliteBundle\MarcoSimbuergerMonitoringSatelliteBundle::class => ['all' => true],
];
```

## Configuration

### Import the route
Import the MonitoringSatelliteBundle's route in your Symfony application.

```yaml
# config/routes.yaml

monitoringsatellite_get:
    resource: "@MarcoSimbuergerMonitoringSatelliteBundle/Resources/config/routes.yaml"
```

### Configure your application's security.yml
In order to secure the MonitoringSatelliteBundle, you must do so in the security file.
The `security.yml` file is where the basic security configuration for your application is contained.

For the _encoders_, define the `Symfony\Component\Security\Core\User\User` class. This internal class is used by Symfony to represent in-memory users.

Under the _providers_ section, create a `monitoring_satellite_auth_provider` provider and configure an in-memory user with a password.
Use `bin/console security:encode-password` to generate the password hash.

Define the authentication under the _firewall_ section. Add the pattern for the MonitoringSatelliteBundle's route and define the previous created provider for the basic authentication.

The _access_control_ section is where you specify the credentials necessary for users trying to access specific parts of your application. Define the route there again.

Below is an example of the configuration necessary to use the MonitoringSatelliteBundle in your application:

```yaml
# config/packages/security.yaml

security:
    encoders:
        Symfony\Component\Security\Core\User\User:
            algorithm: auto

    providers:
        monitoring_satellite_auth_provider:
            memory:
                users:
                    # Define a user with password.
                    # Use 'bin/console security:encode-password' to generate the password hash.
                    foo:
                        password: '$argon2id$v=19$m=65536,t=4,p=1$ofPY6RT+0rCE74M0AlPpzQ$BeiGUhv27D4/6FBmNKC0r4dhImZqj55EfOwYqjxaVbE'
                        roles: ROLE_USER

    firewalls:
        # Secure the MonitoringSatelliteBundle's route with basic auth.
        monitoring_satellite_controller:
            pattern: ^/monitoring-satellite/v1/get
            http_basic:
                provider: monitoring_satellite_auth_provider

    access_control:
        - { path: ^/monitoring-satellite/v1/get, roles: ROLE_USER }

```

## Test
Call `/monitoring-satellite/v1/get`.

It should be protected by basic authentication and return the app data after successful authentication.

## Add the Satellite to the Station
Add this Monitoring Satellite to the Monitoring Station. See [documentation of the Monitoring Station](https://github.com/marcosimbuerger/monitoring-station).

## License
This bundle is released under the MIT license. See the included [LICENSE](LICENSE) file for more information.
