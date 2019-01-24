<template>
    <ul class="pagination" v-if="shouldPaginate" style="margin-top: 16px;">
        <li v-show="prevUrl" style="margin-right: 7px;">
            <a href="#" aria-label="Previous" rel="prev" @click.prevent="page--" class="card card-default">
                <span aria-hidden="true" style="margin-left: 7px; margin-right: 7px;">&laquo; Previous</span>
            </a>
        </li>
        <li v-show="nextUrl">
            <a href="#" aria-label="Next" rel="next" @click.prevent="page++" class="card card-default">
                <span aria-hidden="true" style="margin-left: 7px; margin-right: 7px;">Next &raquo;</span>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['dataSet'],

        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },

            page() {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },

        methods: {
            broadcast() {
                return this.$emit('changed', this.page);
            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>