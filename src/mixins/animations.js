export const AnimationMixin = {
  data () {
    return {
      duration:.5
    }
  },
  methods:{
    fadeEnter(el,done){
      let tl = new TimelineMax;
      tl.from(el,this.duration,{
        opacity:0,
        onComplete:done
      })
    },
    fadeLeave(el,done){
      let tl = new TimelineMax;
      tl.to(el,this.duration,{
        opacity:0,
        onComplete:done
      })
    },
    scaleXEnter(el,done){
      let tl = new TimelineMax;
      tl.from(el,this.duration,{
        scaleX:0,
        onComplete:done
      })
    },
    scaleXLeave(el,done){
      let tl = new TimelineMax;
      tl.to(el,this.duration,{
        scaleX:0,
        onComplete:done
      })
    },
    scaleYEnter(el,done){
      let tl = new TimelineMax;
      tl.from(el,this.duration,{
        scaleY:0,
        onComplete:done
      })
    },
    scaleYLeave(el,done){
      let tl = new TimelineMax;
      tl.to(el,this.duration,{
        scaleY:0,
        onComplete:done
      })
    },
    textEnter(el,done){
      let tl = new TimelineMax;

    },
    test(el,done){

    },
    fadeInUp(el,done){
      let tl = new TimelineMax;
      tl.from(el,this.duration,{
        y:20,
        opacity:0,
        onComplete:done
      })
    },
    fadeInDown(el,done){
      let tl = new TimelineMax;
      tl.from(el,this.duration,{
        y:-20,
        opacity:0,
        onComplete:done
      })
    },
    fadeInScale(el,done){
      let tl = new TimelineMax;
      tl.from(el,this.duration,{
        scale:.5,
        opacity:0,
        ease: Elastic.easeOut.config(1, 0.75),
        onComplete:done
      })
    }
  }
}
