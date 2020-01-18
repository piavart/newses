<template>
    <div>
        <div v-if="news.title !== undefined">
            <b-form @submit.prevent="onSubmit">

                <b-form-group id="input-group-3" label="Категория:" label-for="input-3">
                    <b-form-select
                            id="input-3"
                            v-model="category"
                            required
                    >
                        <option value="">Укажите категорию</option>
                        <option v-for="cat in categories" :value="cat.id">{{cat.name}}</option>
                    </b-form-select>
                </b-form-group>
                <b-form-group id="input-group-4" label="Тип новости:" label-for="input-4">
                    <b-form-select
                            id="input-4"
                            v-model="type"
                            required
                    >
                        <option v-for="t in types" :value="t.id">{{t.name}}</option>
                    </b-form-select>
                </b-form-group>
                <b-form-group
                        id="input-group-1"
                        label="Заголовок:"
                        label-for="input-1"
                >
                    <b-form-input
                            id="input-1"
                            v-model="title"
                            type="text"
                            required
                            placeholder="Укажите заголовок"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-2" label="Контент:" label-for="textarea">
                    <b-form-textarea
                            id="textarea"
                            v-model="content"
                            placeholder="Текст новости"
                            rows="3"
                            max-rows="6"
                    ></b-form-textarea>
                </b-form-group>
                <b-form-group v-if="type === 2" id="input-group-5" label="Дополнительное поле (не имеет своей колонки):" label-for="dop">
                    <b-form-input
                            id="dop"
                            v-model="dop"
                            placeholder="Значение"
                    ></b-form-input>
                </b-form-group>

                <div class="errors text-danger" v-if="errors.length > 0">
                    <p v-for="error in errors">{{error}}</p>
                </div>


                <b-button type="submit" variant="primary">Submit</b-button>
            </b-form>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Edit",
        props: {
            categories:     Array,
            types:          Array,
            id:             Number
        },
        data() {
            return {
                news:           {},
                category:       '',
                title:          '',
                content:        '',
                type:           3,
                dop:            '',
                errors:         []
            }
        },
        mounted() {
            this.fetch();
        },
        methods: {
            fetch(){
                axios.post(`/news/${this.id}/edit`).then( resp => {
                    let news = resp.data.news
                    this.category = news.category_id
                    this.title = news.title
                    this.content = news.content
                    this.type = news.type_id
                    this.dop = news.dop
                    this.news = news
                } )
            },
            onSubmit(){
                this.errors = [];
                axios.post(`/news/${this.id}/update`,{
                    category: this.category,
                    title: this.title,
                    content: this.content,
                    type: this.type,
                    dop: this.dop,
                }).then(resp => {
                    window.location.href = '/news/'+ this.news.id

                }).catch(error => {
                    for (var err in error.response.data.errors){
                        this.errors = this.errors.concat(error.response.data.errors[err])
                    }
                })
            },
            reset(){

            }
        }
    }
</script>

<style scoped>

</style>