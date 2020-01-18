<template>
    <div class="pb-5">
        <div class="col-12 mt-5">
            <v-md-date-range-picker
                    :showActivatorLabel="false"
                    :startDate="startDate"
                    @change="SetDate"
            ></v-md-date-range-picker>
        </div>
        <div class="col-12 mt-5 mb-5">
            <b-nav tabs fill>
                <b-nav-item :disabled="loading" :active="category === 'all'" @click="SetCategory('all')">Все новости</b-nav-item>
                <b-nav-item :disabled="loading" :active="category === cat.id" v-for="cat in categories" @click="SetCategory(cat.id)" :key="cat.id">{{cat.name}}</b-nav-item>
            </b-nav>
        </div>
        <div class="col-12">
            <b-card class="mt-3" v-for="n in news" :title="n.title" :sub-title="n.category.name +` (${n.type.name})`" :key="n.id">
                <b-card-text>
                    {{n.content}}
                </b-card-text>

                <div v-if="n.type_id === 4">
                    <p class="mb-0">Всего новостей: {{n.extend.count}}</p>
                    <ul>
                        <li v-for="(link,key) in n.extend.links" :key="key">
                            <a :href="`/news/${link.id}`">{{link.title}}</a>
                        </li>
                    </ul>
                </div>

                <p class="mb-0" v-if="n.type_id === 1">
                    Температура: <b>{{n.extend.temperature}}</b>.
                    Давление: <b>{{n.extend.pressure}}</b>.
                    Состояние: <b>{{n.extend.sost}}</b>.
                </p>

                <p class="mb-0" v-if="n.type_id === 2">
                    Дополнительные сведения: <b>{{n.extend.dop}}</b>.
                </p>
                <p class="mb-0"><small>{{n.created_at}}</small></p>
            </b-card>

        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        name: "News",
        props: {
            categories: Array
        },
        data() {
            return {
                startDate: moment().subtract( 15,'days' ).format('YYYY-MM-DD'),
                endDate:   moment().format('YYYY-MM-DD'),
                category: 'all',
                news: [],
                loading: false,
            }
        },
        mounted() {
            this.fetch()
        },
        methods: {
            fetch(){
                this.loading = true;
                axios.post('/',{
                    start: this.startDate,
                    end: this.endDate,
                    category: this.category
                }).then(resp => {
                    this.news = resp.data.news
                    this.loading = false;
                })
            },
            SetDate(data){
                this.startDate = data[0].format('YYYY-MM-DD');
                this.endDate = data[1].format('YYYY-MM-DD');
                setTimeout(()=>{
                    this.fetch();
                },10)
            },
            SetCategory(id){
                this.category = id
                this.fetch();
            }
        }
    }
</script>

<style scoped>

</style>