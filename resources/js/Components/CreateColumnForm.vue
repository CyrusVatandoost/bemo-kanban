<template>
    <div>
        <span>Create Column</span>
        <form @submit.prevent="submit">
            <input type="text" v-model="form.title" />
            <button type="submit">Create</button>
        </form>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue2";

export default {
    setup() {
        const form = useForm({
            title: "",
        });

        const submit = () => {
            form.post("/columns", {
                preserveScroll: true,
                onSuccess: () => {
                    form.reset();
                },
            });
        };

        return {
            form,
            submit,
        };
    },
};
</script>
