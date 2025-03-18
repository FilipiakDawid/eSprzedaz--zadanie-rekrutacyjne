<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\FindById;

use Mockery as m;
use Pet\Entities\Pet;
use Pet\ResponseFactory;
use Pet\Entities\Category;
use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;
use UseCases\Contracts\Pet\Entities\IPet;

trait PetServiceTrait
{
    private function mockPet(): IPet
    {
        $m = m::mock(Pet::class);
        $m->expects('getId')->andReturn(1);
        $m->expects('getName')->andReturn('cat');
        $m->expects('getPhotoUrls')->andReturn(new Collection());
        $m->expects('getTags')->andReturn(new Collection());
        $m->expects('getStatus')->andReturn(PetStatus::Sold);

        $category = m::mock(Category::class);
        $m->expects('getCategory')->andReturn($category);
        $category->expects('getId')->andReturn(1);
        $category->expects('getName')->andReturn('cate');

        return $m;
    }

    private function mockResponseFactory(IPet $pet): void
    {
        $m = m::mock(ResponseFactory::class);
        $m->expects('proceedPetResponse')->andReturn($pet);
        $this->instance(ResponseFactory::class, $m);
    }
}
