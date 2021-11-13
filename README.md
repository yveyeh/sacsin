# SacsiN
The SacsiN project...

## Development

**Required Environment**
> `XAMPP`, `WAMP`, `MAMP`, `LAMP` depending on your OS should be setup with php having `rwx` access.

**Setup**
> To setup this project on your local environment, proceed as follows:
> - Clone this repository into your local server's project root directory. `example: in xampp, "htdocs"`.
> - Import the `sacsin_db.sql` file through your phpmyadmin in order to create the required database for the project on your local server.
> - Configure your `credentials` in the `db_connect.php` file in the `db` folder.
> - Ensure that your sever is running and then on your browser, navigate to the `url`: `http://localhost/sacsin`.<br>
> You should now be able to view the site locally.
> - Click on all link as you care... One of the links to navigate to is `http://localhost/sacsin/login`.<br>
> **Demo credentials:** (Enjoy!)<br>
>   <pre>
>   users: {
>       buyer: {
>           email:  '<code>buyer@sacsin.com</code>',
>           password:  '<code>@buyer123#</code>',
>           role:  '<code>Buyer</code>',
>       },
>       seller: {
>           email:  '<code>seller@sacsin.com</code>',
>           password:  '<code>@seller123#</code>',
>           role:  '<code>Seller</code>',
>       }
>   }
>   </pre>
> - Last but not the least open your cloned project repo in an editor of your choice (`vscode` recommended), go to it's terminal <kbd>Ctrl</kbd> + <kbd>`</kbd> and run the command:
>   ```bash
>   **/sacsin$ git checkout <existing_branch>
>   ```
>   If the branch doesn't exist, run:
>   ```bash
>   **/sacsin$ git checkout -b <new_branch>
>   ```
>   You can now code for life!

**Testing**
> Pending...

## Contributors

