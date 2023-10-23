<template>
    <div class="py-20 mx-5">
        <section class="flex justify-center">
            <a-searchbar></a-searchbar>
        </section>
        
        <section class="mt-20">
            <h1 class="text-lg font-bold">Kategórie</h1>
            <div class="flex flex-wrap">
                <a-category-card class="m-1" v-for="(category, categoryIdx) in categories" :key="categoryIdx" :title="category.title"></a-category-card>
            </div>
        </section>

        <section class="mt-20">
            <h1 class="text-lg font-bold">Najnovšie inzeráty</h1>
            <div class="grid justify-center grid-cols xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap">
                <z-product-card class="m-1" v-for="product in latestProducts" :key="product.id" :product="product"/>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [
                {
                    img: '',
                    title: 'Elektronika',
                },
                {
                    img: '',
                    title: 'Oblečenie',
                },
                {
                    img: '',
                    title: 'Nábytok',
                },
                {
                    img: '',
                    title: 'Náradie',
                },
                {
                    img: '',
                    title: 'Záhrada',
                },
                {
                    img: '',
                    title: 'Hudba',
                },
                {
                    img: '',
                    title: 'Šport',
                },
                {
                    img: '',
                    title: 'Zvieratá',
                },
                {
                    img: '',
                    title: 'Doprava',
                },
                {
                    img: '',
                    title: 'Služby',
                },
                {
                    img: '',
                    title: 'Zoznamka',
                },
                {
                    img: '',
                    title: 'Ostatné',
                },
            ],
            latestProducts: [
                {
                    id: 1,
                    title: 'Honda MSX 125',
                    imageUrl: '@/plugins/app/_assets/_icons/placeholder.svg',
                    price: 49.99,
                    date: '2023-10-01',
                    location: 'Bratislava',
                    views: 1024,
                },
                {
                    id: 2,
                    title: '1 izbový byt, Havanská, Sídlisko Ťahanovce',
                    imageUrl: '@/plugins/app/_assets/_icons/placeholder.svg',
                    price: 79.99,
                    date: '2023-10-05',
                    location: 'Košice',
                    views: 850,
                },
                {
                    id: 3,
                    title: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptas.',
                    imageUrl: '@/plugins/app/_assets/_icons/placeholder.svg',
                    price: "1 000 000 000",
                    date: '2023-09-28',
                    location: 'Bratislava - Petržalka',
                    views: 1235,
                },
                {
                    id: 4,
                    title: 'Product 4',
                    imageUrl: '@/plugins/app/_assets/_icons/placeholder.svg',
                    price: 59.99,
                    date: '2023-10-10',
                    location: 'Miami',
                    views: 720,
                },
                {
                    id: 5,
                    title: 'Product 5',
                    imageUrl: '@/plugins/app/_assets/_icons/placeholder.svg',
                    price: 39.99,
                    date: '2023-10-15',
                    location: 'San Francisco',
                    views: 980,
                },
            ]
        }
    },
    methods: {
        //
    }
}
</script>