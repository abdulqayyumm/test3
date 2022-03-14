<template>
  <div
    class="observer"
    :style="customCss"
  />
</template>

<script>
export default {
  props: {
    options: '',
    onObserved: Function,
    customCss: '',
    sendRatio: false
  },
  data: () => ({
    observer: null
  }),
  mounted () {
    this.init();
  },
  destroyed () {
    this.$nextTick(() => {
      this.observer.disconnect();
    });
  },
  methods: {
    init () {
      const options = this.options || {};
      this.observer = new IntersectionObserver(([entry]) => {
        if(this.sendRatio && entry)
          this.onObserved(entry.intersectionRatio);
        else if (entry && entry.isIntersecting) {
          this.onObserved();
        }
      }, options)
      this.$nextTick(() => {
        this.observer.observe(this.$el);
      });
    }
  },
};
</script>
<style scoped>
.observer {
  position: absolute;
  bottom: 0;
  height: 90vh;
  left: 50%;
}
</style>
