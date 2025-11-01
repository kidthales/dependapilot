# Development Guide

## Requirements

- [Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
- [Git](https://git-scm.com/)
- [Make](https://www.gnu.org/software/make/)

## Quick Start

[Create a GitHub OAuth app](https://docs.github.com/en/apps/oauth-apps/building-oauth-apps/creating-an-oauth-app) with:
- **Homepage URL**: `https://localhost`
- **Authorization callback URL**: `https://localhost/connect/check`

Make note of the 'Client ID' and 'Client secret' provided in the GitHub OAuth app dashboard. 

```shell
git clone https://github.com/kidthales/dependapilot.git
cd dependapilot
make build
echo 'OAUTH_GITHUB_CLIENT_ID="Client ID"' > .env.dev.local
echo 'OAUTH_GITHUB_CLIENT_SECRET="Client secret"' >> .env.dev.local
make up
```
