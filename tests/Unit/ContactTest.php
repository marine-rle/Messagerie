<?php

namespace Tests\Unit;

use App\Http\Controllers\ContactController;
use App\Http\Repositories\ContactRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }

    public function testIndexMethodReturnsCorrectView()
    {
        $response = $this->get(route('contact.index'));
        $response->assertStatus(200);
        $response->assertViewIs('contact.index');
    }

    public function testStoreMethodRedirectsToIndex()
    {
        // Créer un mock du repository
        $mockRepository = Mockery::mock(ContactRepository::class);

        // Injecter le mock du repository dans le contrôleur
        $controller = new ContactController($mockRepository);

        // Créer une fausse requête avec les données que vous souhaitez tester
        $requestData = [
            'name' => 'test',
            'message' => 'test',
            // autres champs...
        ];

        $request = new Request($requestData);

        // Définir l'attente sur la méthode store du repository
        $mockRepository
            ->shouldReceive('store')
            ->once()
            ->with(Mockery::on(function ($arg) use ($requestData) {
                return $arg instanceof Request &&
                       $arg->input('name') === $requestData['name'] &&
                       $arg->input('message') === $requestData['message'];
                // Ajoutez d'autres conditions pour les autres champs si nécessaire
            }));

        // Appeler la méthode store du contrôleur
        $response = $controller->store($request);

        // Vérifier que la réponse est une instance de RedirectResponse
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);

        // Extraire l'URL de redirection de la réponse
        $redirectUrl = $response->getTargetUrl();

        // Vérifier que l'URL de redirection correspond à la route 'contact.index'
        $this->assertEquals(route('contact.index'), $redirectUrl);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close(); // Fermer les mocks pour éviter les fuites de mémoire
    }


}
