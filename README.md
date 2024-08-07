# System Zarządzania Książkami

## Opis

To aplikacja stworzona przy użyciu Symfony 6 i PHP 8.0, która umożliwia zarządzanie książkami. Aplikacja obsługuje operacje CRUD dla książek, w tym dodawanie, edytowanie, usuwanie i wyświetlanie książek. Oferuje również funkcjonalność wyszukiwania książek, wyświetlanie okładki oraz paginację.

## Wymagania

- Symfony 6 lub wyższy
- PHP 8.0 lub wyższy
- Relacyjna baza danych (np. MySQL, PostgreSQL)

## Instalacja

### 1. Klonowanie Repozytorium

```bash
git clone //https://github.com/Foxx1990/book_manager
cd your-repository-directory
```bash
2. Instalacja Wymagań
Zainstaluj zależności projektu za pomocą Composer:
```bash
composer install
```bash
3. Konfiguracja Bazy Danych
```bash Skopiuj plik .env do .env.local i skonfiguruj parametry bazy danych: 
cp .env .env.local
Edytuj .env.local, aby ustawić odpowiednie wartości dla DATABASE_URL:
DATABASE_URL="mysql://username:password@127.0.0.1:3306/your_database_name"
```bash
4. Migracje Bazy Danych
```bash
Utwórz bazę danych i zastosuj migracje:

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```bash
5. Załaduj Dane Testowe
Aby załadować dane testowe, użyj poniższego polecenia:
```bash
php bin/console doctrine:fixtures:load
```bash
6. Uruchomienie Serwera
Uruchom wbudowany serwer Symfony:
```bash
symfony serve
lub, jeśli nie używasz Symfony CLI:
php bin/console server:run
```bash


Funkcjonalności
CRUD dla książek: Dodawanie, edytowanie, usuwanie i wyświetlanie książek.
Wyszukiwanie: Możliwość wyszukiwania książek po tytule lub autorze.
Paginacja: Wyświetlanie książek z paginacją.
Wyświetlanie okładek: Możliwość dodawania i wyświetlania okładek książek.
Bezpieczeństwo: Ochrona formularzy za pomocą tokenów CSRF.
Użycie
Dodawanie książek: Przejdź do /books/new, aby dodać nową książkę.
Edycja książek: Przejdź do /book/{id}/edit, aby edytować istniejącą książkę.
Usuwanie książek: Kliknij przycisk "Delete" obok książki na liście książek.
Wyświetlanie szczegółów książki: Przejdź do /book/{id}, aby zobaczyć szczegóły książki, w tym okładkę.
Wyszukiwanie książek: Użyj pola wyszukiwania na stronie listy książek.
