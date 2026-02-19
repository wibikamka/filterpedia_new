<?php

// namespace App\Services;

// use App\Models\Category;
// use Illuminate\Support\Facades\DB;

// class CategoryService
// {
//     public function __construct(
//         protected SlugService $slugService
//     ) {}

//     public function create(array $data): Category
//     {
//         $data['slug'] = $this->slugService->generate(
//             $data['name'],
//             Category::class
//         );

//         return Category::create($data);
//     }

//     public function update(Category $category, array $data): Category
//     {
//         if ($data['name'] !== $category->name) {
//             $data['slug'] = $this->slugService->generate(
//                 $data['name'],
//                 Category::class,
//                 'slug',
//                 $category->id
//             );
//         }

//         $category->update($data);

//         return $category;
//     }
// }
