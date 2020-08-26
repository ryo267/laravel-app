<template>
    <div class="container-fluid">
        <div class="row py-5">
            <div class="col">
                <form
                    action="https://docs.google.com/forms/d/e/1FAIpQLSd5AmsOTtuqXjgy8EMtBwttFIcn3WAtGFrvbI5glefCDZXqmA/formResponse?embedded=true"
                    method="post"
                    target="hidden_iframe"
                    @submit.prevent="onSubmit"
                >
                    <div class="form-group row">
                        <div class="col">
                            <div>
                                <label for="form-name" class="" id="label"
                                    >アカウントネーム</label
                                >
                            </div>
                            <div>
                                <input
                                    type="text"
                                    name="entry.1729818369"
                                    placeholder="アカウントネーム"
                                    v-model="screen_name"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>
                                <label for="detail" class="" id="label"
                                    >お問い合わせ内容</label
                                >
                            </div>
                            <div>
                                <input type="hidden" value="" />
                                <textarea
                                    name="entry.160410273"
                                    placeholder="お問い合わせ内容を入力"
                                    v-model="text"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col text-center">
                            <button
                            v-if="screen_name != ''  && text != ''"
                                type="submit"
                                name="button"
                                value="送信する"
                            >
                                問い合わせる
                            </button>
                        </div>
                    </div>
                </form>
                <iframe
                    name="hidden_iframe"
                    id="hidden_iframe"
                    style="display:none;"
                ></iframe>
            </div>
        </div>
        <div v-if="submitted" class="text-center text-success" id="">
            <h1>お問い合わせを受け付けました</h1>
        </div>
        <div v-if="error && submitted != true" class="text-center text-danger" id="">
            <h1>アカウント名とお問い合わせ内容を入力してください</h1>
        </div>
    </div>
</template>

<script>
export default {
    name: "google-form-component",
    data: function() {
        return {
            submitted: false,
            screen_name: "",
            text: "",
            error: false,
        };
    },
    methods: {
        onSubmit() {
            if( this.screen_name != "" && this.text != "" ){
                this.submitted = true;
                this.screen_name = "";
                this.text = "";
            }else {
                error = true;
            }
        }
    },
    mounted() {}
};
</script>
