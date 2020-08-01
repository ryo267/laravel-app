<template>
    <div class="container-fluid">
        <div class="row py-5">
            <div class="col">
                <form
                    action="https://docs.google.com/forms/d/e/1FAIpQLSd5AmsOTtuqXjgy8EMtBwttFIcn3WAtGFrvbI5glefCDZXqmA/formResponse?embedded=true"
                    method="post"
                    target="hidden_iframe"
                    onsubmit="submitted=true;"
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
                                />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div>
                                <label for="detail" class="" id="label"
                                    >問い合わせ内容</label
                                >
                            </div>
                            <div>
                                <input type="hidden" value="" />
                                <textarea
                                    name="entry.160410273"
                                    placeholder="問い合わせ内容を入力"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col text-center">
                            <button
                                type="submit"
                                name="button"
                                value="送信する"
                            >
                                送信する
                            </button>
                        </div>
                    </div>
                </form>
                <iframe
                    name="hidden_iframe"
                    id="hidden_iframe"
                    style="display:none;"
                    onload=""
                ></iframe>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "google-form-component",
    data: function() {
        return {
            submitted: false,
        };
    },
    methods: {
        modal() {
            
        },
    },
    mounted() {

    }
};
</script>
