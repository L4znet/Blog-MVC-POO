# Blog-MVC-POO
Un blog MVC en POO réalisé dans le cadre de mes études


## Structure de donnnées : 

3 bases de données : articles, comments, users

**Users :**
* id
* username (varchar)
* password (varchar)
* rank (int) (0 valeur par défaut)
* updated_at (datetime) (current_timestamp valeur par défaut)

**articles**
* id
* title (varchar) (NULL valeur par défaut)
* text (longtext) (NULL valeur par défaut)
* created_at (datetime) (NULL valeur par défaut)
* updated_at (datetime) (NULL valeur par défaut)
* deleted (int) (NULL valeur par défaut)

**comments**
* id
* article_id (int)
* text (longtext)
* author (varchar)
* created_at (datetime) (current_timestamp valeur par défaut)
* updated_at (datetime) (current_timestamp valeur par défaut)
* deleted (int) (NULL valeur par défaut)
* validate (int)

