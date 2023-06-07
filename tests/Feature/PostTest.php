<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    //We use this to refresh the dummy database
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No posts found!');
    }

    public function testSee1BlogPostWhenThereIs1WithNoComments()
    {

        // Arrange 
        $post = $this->createDummyBlogPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function testSee1BlogPostWithComments()
    {
        // Arrange 
        $user = $this->user();

        $post = $this->createDummyBlogPost();
        Comment::factory(4)->create([
            'commentable_id' => $post->id,
            'commentable_type' => 'App\Models\BlogPost',
            'user_id' => $user->id,
        ]);

        // Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('4 comments');
    }

    public function testStoreValid()
    {
        //Creating the dummy user 
        $user = $this->user();

        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        //We tell Laravel how to act/use that user
        $this->actingAs($user);

        //Redirect succesful code 302 
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was created!');
    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];
        //Concise way of creating the dummy user
        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors');
        $messages = $messages->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        // Arrange 
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed'
        ];

        //Act
        $this->actingAs($user)
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        //Assert
        $this->assertEquals(session('status'), 'Blog post was updated!');

        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new named title'
        ]);
    }

    public function testDelete()
    {
        // Arrange 
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);
        $this->assertDatabaseHas('blog_posts', $post->getAttributes());
        // Act
        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        //Assert
        $this->assertEquals(session('status'), 'Blog post was delete!');
        $this->get("/posts");
        // $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertSoftDeleted('blog_posts', $post->getAttributes());
    }

    public function testDeleteAuthorizationDifferentLoggedInUserFail() {

        $user = $this->user();
        // $user->cannot()
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', $post->getAttributes());
        // Act
        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(403);


    }

    // public function testDeleteAuthorizationNoLoggedInUserFail() {

        
    //     $post = $this->createDummyBlogPost();
    //     $this->assertDatabaseHas('blog_posts', $post->getAttributes());
    //     // Act
    //     $this->delete("/posts/{$post->id}")
    //         ->assertStatus(403);


    // }

    private function createDummyBlogPost($userId = null): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of the blog post';
        $post->save();

        return BlogPost::factory()->newPost()->create(
            ['user_id' => $userId ?? $this->user()->id,]
        );
        return $post;
    }
}
