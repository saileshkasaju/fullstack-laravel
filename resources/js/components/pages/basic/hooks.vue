<template>
    <div>
        <h1 ref="myref">Hook tutorial</h1>
        <p>My name is {{ name }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "sailesh"
        };
    },
    beforeCreate() {
        console.log(this.name);
    },
    created() {
        console.log(
            "data and other properties are available but not html",
            this.name
        );
    },
    mounted() {
        // after html mounts
        console.log(this.$refs.myref);
    }
};
</script>
