<template>
    <div class="container bg-red">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example componen
                    </div>
                </div>
            </div>

            <div>
                <a-button type="primary">
                    Primary
                </a-button>
                <a-button>Default</a-button>
                <a-button type="dashed">
                    Dashed
                </a-button>
                <a-button type="danger">
                    Danger
                </a-button>
                <a-config-provider :auto-insert-space-in-button="false">
                    <a-button type="primary">
                        按钮
                    </a-button>
                </a-config-provider>
                <a-button type="primary">
                    按钮
                </a-button>
                <a-button type="link">
                    Link
                </a-button>
            </div>
        </div>
        <h1 class="text-danger">kkkk</h1>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
<style lang="scss">
// .container {
//     background: red;
// }
</style>
