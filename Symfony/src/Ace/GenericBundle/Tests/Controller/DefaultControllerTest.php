<?php

namespace Ace\GenericBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultControllerTest extends WebTestCase
{
    public function testIndex()   // Test homepage and redirection bug
    {
        $client = static::createClient();        
		$crawler = $client->request('GET', '/');
		
		$this->assertFalse($client->getResponse()->isRedirect());
		
		$this->assertGreaterThan(0, $crawler->filter('html:contains("enter codebender.")')->count());
		
		$client->request('GET', '/list');
		$this->assertTrue($client->getResponse()->isRedirect('/'));
    }
	
	 
	public function testUser()  // Test user page
	{
		$client = static::createClient();        
		
		$crawler = $client->request('GET', '/user/tzikis');
		
		$this->assertGreaterThan(0, $crawler->filter('html:contains("tzikis (Georgitzikis Vasilis)")')->count());
		
		$matcher = array('id'   => 'user_projects');
		$this->assertTag($matcher, $client->getResponse()->getContent()); 
	
	}
	 
	
	public function testProject() // Test project page
	{
		$client = static::createClient();        
		
		$crawler = $client->request('GET', '/user/tzikis');
		
		$client->followRedirects();
		
		$link = $crawler->filter('#user_projects')->children()->eq(1)->children()->children()->children()->link();
		$crawler = $client->click($link); 		
			
		$matcher = array('id'   => 'code-container');
		$this->assertTag($matcher, $client->getResponse()->getContent()); 
		
	
	}
	
	public function testLibraries()
	{
		
	
	
	
	}
	

	
}
