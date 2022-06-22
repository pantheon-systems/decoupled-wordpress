# Composer-enabled Decoupled Wordpress Project

This is Pantheon's recommended starting point for creating new decoupled Wordpress backend sites. It builds on Pantheon's default Wordpress composer upstream to provide best practices, default configuration, and accellerator tools for using Wordpress as a backend in decoupled archictures.

Unlike with earlier Pantheon upstreams, files such as Wordpress Core that you are
unlikely to adjust while building sites are not in the main branch of the
repository. Instead, they are referenced as dependencies that are installed by
Composer.

## Installation

### Prerequisites

- Composer (required for CMS backends): [Install Globally](https://getcomposer.org/download/)
- [Generate machine token](https://pantheon.io/docs/machine-tokens#create-a-machine-token) & [Authenticate into Terminus](https://pantheon.io/docs/machine-tokens#authenticate-into-terminus)
- [Install Terminus](https://pantheon.io/docs/terminus/install) (3.0.0 above required)
- Also install the following plugins:
    - `terminus self:plugin:install terminus-build-tools-plugin`
    - `terminus self:plugin:install terminus-power-tools`
    - `terminus self:plugin:install terminus-secrets-plugin`
    - Reload the terminus plugins: `terminus self:plugin:reload`
    - Clear cache for composer: `composer clear-cache`
    - Validate that the required plugins are installed: `terminus self:plugin:list`
- Create [Github Personal access tokens](https://github.com/settings/tokens)
- Create [CircleCI Personal API Tokens](https://app.circleci.com/settings/user/tokens)

### Installation via `terminus build:project:create`

- Run the `terminus build:project:create` as follows:

  ```
  terminus build:project:create \
    --team='{My Team Name}' \
    --template-repository="git@github.com:pantheon-systems/decoupled-wordpress-recommended.git" \
    pantheon-systems/decoupled-wordpress-recommended \
    --ci-template='git@github.com:pantheon-systems/advanced-ci-templates' \
    --visibility private {PROJECT_NAME} \
    --stability=dev
  ```

  Replace `{PROJECT_NAME}` with a Project name for example `decoupled-wordpress`.

  Replace `{My Team Name}` with your team name - for example `My Agency`. This can also be omitted.

**Note:** This will result in a Github repository being created for this new codebase, a site being created on Pantheon and a CircleCI project being created for automated deployments.

### Additional Options

#### Using Other Git Hosts or CI Services

Terminus build tools supports a number of other combinations of git hosts and CI services.

For example, to use GitHub actions as your CI service, you could add the following additional flag to your `terminus build:project:create` command:

`--ci=githubactions`

Other possible values are `circleci`, `gitlab-pipelines` and `bitbucket-pipelines`.

Note: if using Github Actions, your token should have the "workflow" scope.

For more information, consult the [available services section of the build tools documentation](https://github.com/pantheon-systems/terminus-build-tools-plugin#available-services)

#### Using a GitHub Organization

`--org="{My Organization Name}"`

If you would like the repo created to be under a GitHub organization instead of the authenticated user's namespace, you can use the `--org` option.

For information on additional options, consult the [command options section of the build tools documentation](https://github.com/pantheon-systems/terminus-build-tools-plugin#command-options).

## Contributing

Contributions are welcome in the form of GitHub pull requests. However, the
`pantheon-upstreams/decoupled-wordpress-project` repository is a mirror that does not
directly accept pull requests.

Instead, to propose a change, please fork [pantheon-systems/decoupled-wordpress-project](https://github.com/pantheon-systems/decoupled-wordpress-project)
and submit a PR to that repository.
