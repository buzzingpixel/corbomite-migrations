# Corbomite Migrations

<p><a href="https://travis-ci.org/buzzingpixel/corbomite-migrations"><img src="https://travis-ci.org/buzzingpixel/corbomite-migrations.svg?branch=master"></a></p>

Part of BuzzingPixel's Corbomite project.

Provides a light wrapper around [Phinx](https://phinx.org/) to make it available to Corbomite.

## Usage

### APP_BASE_PATH constant

You can define `APP_BASE_PATH` as a constant to give Corbomite DB knowledge about the app's base path, otherwise Crobomite DB will try to figure it out automatically.

### Environment variables

#### Required environment variables

- `DB_DATABASE`
- `DB_USER`
- `DB_PASSWORD`

#### Optional environment variables

- `PHINX_MIGRATION_TABLE` (default: `migrations`)
- `PHINX_ADAPTER` (default: `mysql`)
- `DB_HOST` (default: `localhost`)
- `DB_PORT` (default: `3306`)
- `DB_CHARSET` (default: `utf8mb4`)
- `DB_COLLATION` (default: `utf8mb4_general_ci`)
- `PHINX_VERSION_ORDER` (default: `creation`)

### CLI commands

Once you've composer required into your Corbomite project, there will be some new commands available on the command line.

#### `migrate/create-sample-config`

Creates a `phinx.php` config file with sample values at the root of your project.

#### `migrate/create`

Creates a migration file in the directory specified in your `phinx.php` config file.

#### `migrate/status`

Shows the status of migrations.

#### `migrate/up`

Runs any migrations that have not yet been run.

#### `migrate/down`

Rolls back the previous migration or to the specified target.

## License

Copyright 2019 BuzzingPixel, LLC

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at [http://www.apache.org/licenses/LICENSE-2.0](http://www.apache.org/licenses/LICENSE-2.0).

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
