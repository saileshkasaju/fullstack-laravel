export default {
    data() {
        return {};
    },
    methods: {
        async callApi(method, url, data) {
            try {
                return await axios({
                    method,
                    url,
                    data
                });
            } catch (e) {
                return e.response;
            }
        },
        i(desc, title = "Hey") {
            this.$Notice.info({
                title,
                desc
            });
        },
        s(desc, title = "Great!") {
            this.$Notice.success({
                title,
                desc
            });
        },
        w(desc, title = "Oops!") {
            this.$Notice.warning({
                title,
                desc
            });
        },
        e(desc, title = "Oops!") {
            this.$Notice.error({
                title,
                desc
            });
        },
        swr(desc = "Something went wrong! Please try again.", title = "Oops") {
            this.$Notice.error({
                title,
                desc
            });
        }
    }
};
