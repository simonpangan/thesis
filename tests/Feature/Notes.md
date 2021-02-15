
php artisan test --filter test_a_book_can_be_added_to_the_library 

php artisan test --filter test_a_title_is_required

php artisan test --filter test_a_author_is_required


php artisan test --filter test_a_book_can_be_updated

php artisan test --filter test_a_book_can_be_deleted


//

php artisan test --filter BookManagementTest
php artisan test --filter AuthorManagementTest

php artisan test --filter test_an_author_can_be_created
php artisan test --filter test_a_new_author_is_automatically_added


php artisan test --filter test_only_name_is_required_to_create_an_author


//UNIT TESTING
php artisan test --filter testOnlyNameIsRequiredToCreateAnAuthor
php artisan test --filter test_an_author_id_is_recorded
