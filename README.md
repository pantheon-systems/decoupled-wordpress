# kporras07wpbedrock2

[![CircleCI](https://circleci.com/gh/kporras07/kporras07wpbedrock2.svg?style=shield)](https://circleci.com/gh/kporras07/kporras07wpbedrock2)
[![Dashboard kporras07wpbedrock2](https://img.shields.io/badge/dashboard-kporras07wpbedrock2-yellow.svg)](https://dashboard.pantheon.io/sites/4905ff84-d462-4344-bf89-d2f5dcfda32e#dev/code)
[![Dev Site kporras07wpbedrock2](https://img.shields.io/badge/site-kporras07wpbedrock2-blue.svg)](http://dev-kporras07wpbedrock2.pantheonsite.io/)

## Local Development

We recommend using Lando for local development:

https://lando.dev/

After installing Lando, you can initialize your local development environment by running:
```
# Go through interactive prompts to get your site from pantheon
lando init --source pantheon

# OR do it non-interactively
lando init \
  --source pantheon \
  --pantheon-auth "$PANTHEON_MACHINE_TOKEN" \
  --pantheon-site "$PANTHEON_SITE_NAME"

# Start it up
lando start

# Import your database and files
lando pull

# List information about this app.
lando info
```

Additional details on configuring the Pantheon Lando recipe can be found in the [Lando Docs](https://docs.lando.dev/config/pantheon.html).

After starting up your local development environment, note the Edge URLs for your site. With your Lando environment up and running, you can either navigate to the site in your browser to install, or use the following command:

```
lando wp core install --url=your-edge-url.lndo.site --title=Example --admin_user=supervisor --admin_password=strongpassword --admin_email=info@example.com
```