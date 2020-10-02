<Todo : personalize readme>

# App base built with Laravel 8

| Develop | Master |
|---|---|
| `<build-status-badge>` | `<build-status-badge>` |
| `<coverage-report-badge>` | `<coverage-report-badge>` |

## Team

* Lead dev: [Okipa](https://github.com/Okipa)
* Quality: [Okipa](https://github.com/Okipa)
* Management: [Okipa](https://github.com/Okipa)
* Devs: https://github.com/ACID-Solutions/starter/graphs/contributors

## Table of Contents

* [Installation](#installation)
  * [Requirements](#requirements)
  * [Import and git setup](#import-and-git-setup)
  * [DNS setup](#dns-setup)
  * [Project configuration and dependencies installation](#project-configuration-and-dependencies-installation)
* [Docker](#docker)
* [Database](#database)
* [Building resources](#building-resources)
* [Testing](#testing)
* [Debugging](#debugging)
* [Changelog](#changelog)

## Installation

### Requirements

* Git.
* Docker Community Edition: https://docs.docker.com/install.
* Latest Node LTS version (important to avoid errors).
* Latest Yarn stable version.

### Import and git setup

Clone the project from `<project-repository-url>`.

### DNS setup

Set your project domain resolution in your virtualhost: `sudo vim /etc/hosts`

```sh
    # add these lines in your /etc/hosts file
    <project-local-ip>   <project-local-dns>
```

### Project configuration and dependencies installation

* `composer install --no-scripts --ignore-platform-reqs`
* `cp .env.example .env`. Then set the environment variables according to your project needs.
* `./vessel start`
* `./vessel composer update`
* `./vessel artisan key:generate`
* `./vessel artisan storage:link`
* `./vessel artisan migrate:refresh --seed`
* `yarn install`
* `yarn upgrade`
* `yarn dev` or `yarn watch`

## Docker

This project uses [Vessel](https://vessel.shippingdocker.com).

Vessel offers a useful bash file containing multiple shortcuts for your Docker environment. You can still run pure `docker` or `docker-compose` commands from the project directory.

See how to use it on the [official documentation](https://vessel.shippingdocker.com/docs/everyday-usage).

## Database

* Execute a database reset with the following command: `./vessel artisan migrate:refresh --seed`. This will execute all migrations and seeds.

## Building resources

Compile all your project resources (mainly sass and javascript) by executing the following commands.
You can run these commands from your docker workspace, Node and Yarn are being installed. However, running them from your host machine will be quicker.

* `yarn dev` (does merge but does not minify resources).
* `yarn prod` (does merge **and** minify).
* `yarn watch` (recompile automatically when a change is being detected in a resource file).

## IDE helper

* To manually generate IDE helper files, run the following command: `./vessel composer ide-helper`.

## Testing

* To launch the project test, run the following command: `./vessel composer test`.

## Debugging

Laravel Telescope and Laravel Horizon are pre-installed:
* To open the `telescope` dashboard, add `/telescope` to the base URL.
* To open the `horizon` dashboard, add `/horizon` to the base URL.

## Changelog

See the [CHANGELOG](CHANGELOG.md) for more information on what has been pushed in production.
