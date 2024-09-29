import * as _nuxt_schema from '@nuxt/schema';

interface CarouselOptions {
    prefix: string;
}
declare const _default: _nuxt_schema.NuxtModule<CarouselOptions, CarouselOptions, false>;

declare module '@nuxt/schema' {
    interface NuxtConfig {
        carousel?: CarouselOptions;
    }
    interface NuxtOptions {
        carousel?: CarouselOptions;
    }
}

export { type CarouselOptions, _default as default };
