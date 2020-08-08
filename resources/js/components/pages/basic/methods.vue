<template>
    <div>
        <h1>We can have some data here</h1>
        <p>The number is {{ views }}</p>
        <button @click="updateViews(1)">Increase</button>
        <button @click="updateViews(-1)">Decrease</button>
        <br />
        <br />
        <br />
        <div v-if="blogs.length">
            <div v-for="(blog, i) in blogs" :key="i">
                <h1>{{ blog.title }}</h1>
                <p>{{ blog.post }}</p>
            </div>
        </div>

        <br />
        <br />
        <br />

        <div>
            <h1 v-if="showItem">show this item if showItem is true</h1>
            <p v-else>show this item if showItem is false</p>
        </div>
        <button @click="showItem = !showItem">ChangeShowItem</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            views: 0,
            blogs: [],
            showItem: false
        };
    },
    methods: {
        updateViews(number) {
            this.views += number;
        },
        changeShowItem() {
            this.showItem = !this.showItem;
        }
    },
    created() {
        // call the server to get views of this blog post
        this.views = 100;
        const posts = [
            {
                title: "this is a blog 1",
                post: "this is the blog post1",
                id: 1
            },
            {
                title: "this is a blog 2",
                post: "this is the blog post2",
                id: 2
            },
            {
                title: "this is a blog 3",
                post: "this is the blog post3",
                id: 3
            },
            { title: "this is a blog 4", post: "this is the blog post4", id: 4 }
        ];
        this.blogs = posts;
    }
};
</script>
