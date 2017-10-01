<?php 
use SlimRequestParams\BodyParameters;

/**
 * GET getAuthorById
 * Summary: Find author by ID
 * Notes: Returns a single author
 * Output-Formats: [application/json]
 */
$app->GET('/v1/authors/{authorId}', 'GetAuthors');


/**
 * POST addAuthor
 * Summary: Add a new author to the store
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->POST('/v1/authors', 'PostAuthors')
    ->add(new BodyParameters([
        '{name:.+}',
        '{nameAblative:.+}'
]));


/**
 * DELETE deleteAuthor
 * Summary: Deletes a author
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->DELETE('/v1/authors/{authorId}', 'DeleteAuthors');


/**
 * POST updateAuthorWithForm
 * Summary: Updates a author in the store with form data
 * Notes: 
 * Output-Formats: [application/json]
 */
$app->PUT('/v1/authors/{authorId}', 'PutAuthors')
    ->add(new BodyParameters([
        '{name:.+}',
        '{nameAblative:.+}'
]));
