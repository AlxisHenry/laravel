<a name="readme-top"></a>

<div align="center">

  <img src="" alt="APPLICATION LOGO" width="400" height="auto" />

  <h1>TEMPLATE</h1>
  
  <p>
    Purpose of the app
  </p>

<a href=""><strong>Documentation »</strong></a>

<h4>
    <a href="/">Show me the app</a>
  <span> · </span>
    <a href="/">Report a bug</a>
  <span> · </span>
    <a href="">Suggest an idea</a>
  </h4>
</div>

<br />

# :notebook_with_decorative_cover: Summary

- [Getting Started](#toolbox-getting-started)
  * [Setup](#gear-setup)
  * [Tests](#)
  * [Docker](#)
- [Authors](#wave-auteurs)

## :toolbox: Getting Started

### :gear: Setup

**First, you need to create a new repository generated from this template on Github.**

**Clone the repository**

```
  git clone git@github.com:user/repository.git
```

**Enter in project folder**

```bash
  cd repository
```

**Run the setup script**

This script will ask you some informations to configure `.env` of the application.

- Environment type (development/production)
- Database identifiers*
- Emails identifiers*

\* *Care, if you are working with Docker, you will need to configure `APP_HOST` to `mysql`.*

\* *The token isn't available on github, if necessary you have to ask [@AlxisHenry](https://github.com/AlxisHenry).* 

```bash
bash setup.sh
```

**Database setup**

The `database.sh` script does the following steps :

- Drop all tables
- Run all migrations
- Seed the database

```bash
npm run db:setup
```

## :wave: Authors

* **Alexis Henry** _alias_ [@AlxisHenry](https://github.com/AlxisHenry)
<!-- ## :page_with_curl: Liens utiles -->

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- BADGE LINKS -->
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Tailwindcss.com]:https://img.shields.io/badge/Tailwind-0ea5e9?style=for-the-badge&logo=tailwindcss&logoColor=white
[Tailwind-url]: https://tailwindcss.com/ 
[Javascript.com]:https://img.shields.io/badge/javascript%20-%23323330.svg?&style=for-the-badge&logo=javascript&logoColor=fcdc00&color=gray
[Javascript-url]:https://www.javascript.com/