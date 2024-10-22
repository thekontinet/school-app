import{r as i,U as E,t as ae}from"./app-Bt_hU6EC.js";var Oe=Object.defineProperty,je=(e,t,n)=>t in e?Oe(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n,Z=(e,t,n)=>(je(e,typeof t!="symbol"?t+"":t,n),n);let Ae=class{constructor(){Z(this,"current",this.detect()),Z(this,"handoffState","pending"),Z(this,"currentId",0)}set(t){this.current!==t&&(this.handoffState="pending",this.currentId=0,this.current=t)}reset(){this.set(this.detect())}nextId(){return++this.currentId}get isServer(){return this.current==="server"}get isClient(){return this.current==="client"}detect(){return typeof window>"u"||typeof document>"u"?"server":"client"}handoff(){this.handoffState==="pending"&&(this.handoffState="complete")}get isHandoffComplete(){return this.handoffState==="complete"}},U=new Ae;function Pe(e){typeof queueMicrotask=="function"?queueMicrotask(e):Promise.resolve().then(e).catch(t=>setTimeout(()=>{throw t}))}function I(){let e=[],t={addEventListener(n,r,l,a){return n.addEventListener(r,l,a),t.add(()=>n.removeEventListener(r,l,a))},requestAnimationFrame(...n){let r=requestAnimationFrame(...n);return t.add(()=>cancelAnimationFrame(r))},nextFrame(...n){return t.requestAnimationFrame(()=>t.requestAnimationFrame(...n))},setTimeout(...n){let r=setTimeout(...n);return t.add(()=>clearTimeout(r))},microTask(...n){let r={current:!0};return Pe(()=>{r.current&&n[0]()}),t.add(()=>{r.current=!1})},style(n,r,l){let a=n.style.getPropertyValue(r);return Object.assign(n.style,{[r]:l}),this.add(()=>{Object.assign(n.style,{[r]:a})})},group(n){let r=I();return n(r),this.add(()=>r.dispose())},add(n){return e.includes(n)||e.push(n),()=>{let r=e.indexOf(n);if(r>=0)for(let l of e.splice(r,1))l()}},dispose(){for(let n of e.splice(0))n()}};return t}function ue(){let[e]=i.useState(I);return i.useEffect(()=>()=>e.dispose(),[e]),e}let O=(e,t)=>{U.isServer?i.useEffect(e,t):i.useLayoutEffect(e,t)};function ce(e){let t=i.useRef(e);return O(()=>{t.current=e},[e]),t}let F=function(e){let t=ce(e);return E.useCallback((...n)=>t.current(...n),[t])};function G(...e){return Array.from(new Set(e.flatMap(t=>typeof t=="string"?t.split(" "):[]))).filter(Boolean).join(" ")}function q(e,t,...n){if(e in t){let l=t[e];return typeof l=="function"?l(...n):l}let r=new Error(`Tried to handle "${e}" but there is no handler defined. Only defined handlers are: ${Object.keys(t).map(l=>`"${l}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(r,q),r}var fe=(e=>(e[e.None=0]="None",e[e.RenderStrategy=1]="RenderStrategy",e[e.Static=2]="Static",e))(fe||{}),S=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(S||{});function de({ourProps:e,theirProps:t,slot:n,defaultTag:r,features:l,visible:a=!0,name:u,mergeRefs:o}){o=o??Ne;let s=pe(t,e);if(a)return M(s,n,r,u,o);let p=l??0;if(p&2){let{static:f=!1,...h}=s;if(f)return M(h,n,r,u,o)}if(p&1){let{unmount:f=!0,...h}=s;return q(f?0:1,{0(){return null},1(){return M({...h,hidden:!0,style:{display:"none"}},n,r,u,o)}})}return M(s,n,r,u,o)}function M(e,t={},n,r,l){let{as:a=n,children:u,refName:o="ref",...s}=z(e,["unmount","static"]),p=e.ref!==void 0?{[o]:e.ref}:{},f=typeof u=="function"?u(t):u;"className"in s&&s.className&&typeof s.className=="function"&&(s.className=s.className(t)),s["aria-labelledby"]&&s["aria-labelledby"]===s.id&&(s["aria-labelledby"]=void 0);let h={};if(t){let g=!1,d=[];for(let[c,v]of Object.entries(t))typeof v=="boolean"&&(g=!0),v===!0&&d.push(c.replace(/([A-Z])/g,m=>`-${m.toLowerCase()}`));if(g){h["data-headlessui-state"]=d.join(" ");for(let c of d)h[`data-${c}`]=""}}if(a===i.Fragment&&(Object.keys(j(s)).length>0||Object.keys(j(h)).length>0))if(!i.isValidElement(f)||Array.isArray(f)&&f.length>1){if(Object.keys(j(s)).length>0)throw new Error(['Passing props on "Fragment"!',"",`The current component <${r} /> is rendering a "Fragment".`,"However we need to passthrough the following props:",Object.keys(j(s)).concat(Object.keys(j(h))).map(g=>`  - ${g}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "Fragment".',"Render a single element as the child so that we can forward the props onto that element."].map(g=>`  - ${g}`).join(`
`)].join(`
`))}else{let g=f.props,d=g==null?void 0:g.className,c=typeof d=="function"?(...C)=>G(d(...C),s.className):G(d,s.className),v=c?{className:c}:{},m=pe(f.props,j(z(s,["ref"])));for(let C in h)C in m&&delete h[C];return i.cloneElement(f,Object.assign({},m,h,p,{ref:l(f.ref,p.ref)},v))}return i.createElement(a,Object.assign({},z(s,["ref"]),a!==i.Fragment&&p,a!==i.Fragment&&h),f)}function Ne(...e){return e.every(t=>t==null)?void 0:t=>{for(let n of e)n!=null&&(typeof n=="function"?n(t):n.current=t)}}function pe(...e){if(e.length===0)return{};if(e.length===1)return e[0];let t={},n={};for(let r of e)for(let l in r)l.startsWith("on")&&typeof r[l]=="function"?(n[l]!=null||(n[l]=[]),n[l].push(r[l])):t[l]=r[l];if(t.disabled||t["aria-disabled"])for(let r in n)/^(on(?:Click|Pointer|Mouse|Key)(?:Down|Up|Press)?)$/.test(r)&&(n[r]=[l=>{var a;return(a=l==null?void 0:l.preventDefault)==null?void 0:a.call(l)}]);for(let r in n)Object.assign(t,{[r](l,...a){let u=n[r];for(let o of u){if((l instanceof Event||(l==null?void 0:l.nativeEvent)instanceof Event)&&l.defaultPrevented)return;o(l,...a)}}});return t}function J(e){var t;return Object.assign(i.forwardRef(e),{displayName:(t=e.displayName)!=null?t:e.name})}function j(e){let t=Object.assign({},e);for(let n in t)t[n]===void 0&&delete t[n];return t}function z(e,t=[]){let n=Object.assign({},e);for(let r of t)r in n&&delete n[r];return n}let me=Symbol();function Qe(e,t=!0){return Object.assign(e,{[me]:t})}function he(...e){let t=i.useRef(e);i.useEffect(()=>{t.current=e},[e]);let n=F(r=>{for(let l of t.current)l!=null&&(typeof l=="function"?l(r):l.current=r)});return e.every(r=>r==null||(r==null?void 0:r[me]))?void 0:n}function Re(e=0){let[t,n]=i.useState(e),r=i.useCallback(s=>n(s),[t]),l=i.useCallback(s=>n(p=>p|s),[t]),a=i.useCallback(s=>(t&s)===s,[t]),u=i.useCallback(s=>n(p=>p&~s),[n]),o=i.useCallback(s=>n(p=>p^s),[n]);return{flags:t,setFlag:r,addFlag:l,hasFlag:a,removeFlag:u,toggleFlag:o}}var ke={},oe;typeof process<"u"&&typeof globalThis<"u"&&((oe=process==null?void 0:ke)==null?void 0:oe.NODE_ENV)==="test"&&typeof Element.prototype.getAnimations>"u"&&(Element.prototype.getAnimations=function(){return console.warn(["Headless UI has polyfilled `Element.prototype.getAnimations` for your tests.","Please install a proper polyfill e.g. `jsdom-testing-mocks`, to silence these warnings.","","Example usage:","```js","import { mockAnimationsApi } from 'jsdom-testing-mocks'","mockAnimationsApi()","```"].join(`
`)),[]});var xe=(e=>(e[e.None=0]="None",e[e.Closed=1]="Closed",e[e.Enter=2]="Enter",e[e.Leave=4]="Leave",e))(xe||{});function He(e){let t={};for(let n in e)e[n]===!0&&(t[`data-${n}`]="");return t}function Le(e,t,n,r){let[l,a]=i.useState(n),{hasFlag:u,addFlag:o,removeFlag:s}=Re(e&&l?3:0),p=i.useRef(!1),f=i.useRef(!1),h=ue();return O(()=>{var g;if(e){if(n&&a(!0),!t){n&&o(3);return}return(g=r==null?void 0:r.start)==null||g.call(r,n),Me(t,{inFlight:p,prepare(){f.current?f.current=!1:f.current=p.current,p.current=!0,!f.current&&(n?(o(3),s(4)):(o(4),s(2)))},run(){f.current?n?(s(3),o(4)):(s(4),o(3)):n?s(1):o(1)},done(){var d;f.current&&typeof t.getAnimations=="function"&&t.getAnimations().length>0||(p.current=!1,s(7),n||a(!1),(d=r==null?void 0:r.end)==null||d.call(r,n))}})}},[e,n,t,h]),e?[l,{closed:u(1),enter:u(2),leave:u(4),transition:u(2)||u(4)}]:[n,{closed:void 0,enter:void 0,leave:void 0,transition:void 0}]}function Me(e,{prepare:t,run:n,done:r,inFlight:l}){let a=I();return Ie(e,{prepare:t,inFlight:l}),a.nextFrame(()=>{n(),a.requestAnimationFrame(()=>{a.add(Ue(e,r))})}),a.dispose}function Ue(e,t){var n,r;let l=I();if(!e)return l.dispose;let a=!1;l.add(()=>{a=!0});let u=(r=(n=e.getAnimations)==null?void 0:n.call(e).filter(o=>o instanceof CSSTransition))!=null?r:[];return u.length===0?(t(),l.dispose):(Promise.allSettled(u.map(o=>o.finished)).then(()=>{a||t()}),l.dispose)}function Ie(e,{inFlight:t,prepare:n}){if(t!=null&&t.current){n();return}let r=e.style.transition;e.style.transition="none",n(),e.offsetHeight,e.style.transition=r}let _=i.createContext(null);_.displayName="OpenClosedContext";var A=(e=>(e[e.Open=1]="Open",e[e.Closed=2]="Closed",e[e.Closing=4]="Closing",e[e.Opening=8]="Opening",e))(A||{});function ve(){return i.useContext(_)}function qe({value:e,children:t}){return E.createElement(_.Provider,{value:e},t)}function Je({children:e}){return E.createElement(_.Provider,{value:null},e)}function _e(){let e=typeof document>"u";return"useSyncExternalStore"in ae?(t=>t.useSyncExternalStore)(ae)(()=>()=>{},()=>!1,()=>!e):!1}function ge(){let e=_e(),[t,n]=i.useState(U.isHandoffComplete);return t&&U.isHandoffComplete===!1&&n(!1),i.useEffect(()=>{t!==!0&&n(!0)},[t]),i.useEffect(()=>U.handoff(),[]),e?!1:t}function De(){let e=i.useRef(!1);return O(()=>(e.current=!0,()=>{e.current=!1}),[]),e}function be(e){var t;return!!(e.enter||e.enterFrom||e.enterTo||e.leave||e.leaveFrom||e.leaveTo)||((t=e.as)!=null?t:Ee)!==i.Fragment||E.Children.count(e.children)===1}let D=i.createContext(null);D.displayName="TransitionContext";var Ve=(e=>(e.Visible="visible",e.Hidden="hidden",e))(Ve||{});function We(){let e=i.useContext(D);if(e===null)throw new Error("A <Transition.Child /> is used but it is missing a parent <Transition /> or <Transition.Root />.");return e}function Xe(){let e=i.useContext(V);if(e===null)throw new Error("A <Transition.Child /> is used but it is missing a parent <Transition /> or <Transition.Root />.");return e}let V=i.createContext(null);V.displayName="NestingContext";function W(e){return"children"in e?W(e.children):e.current.filter(({el:t})=>t.current!==null).filter(({state:t})=>t==="visible").length>0}function ye(e,t){let n=ce(e),r=i.useRef([]),l=De(),a=ue(),u=F((d,c=S.Hidden)=>{let v=r.current.findIndex(({el:m})=>m===d);v!==-1&&(q(c,{[S.Unmount](){r.current.splice(v,1)},[S.Hidden](){r.current[v].state="hidden"}}),a.microTask(()=>{var m;!W(r)&&l.current&&((m=n.current)==null||m.call(n))}))}),o=F(d=>{let c=r.current.find(({el:v})=>v===d);return c?c.state!=="visible"&&(c.state="visible"):r.current.push({el:d,state:"visible"}),()=>u(d,S.Unmount)}),s=i.useRef([]),p=i.useRef(Promise.resolve()),f=i.useRef({enter:[],leave:[]}),h=F((d,c,v)=>{s.current.splice(0),t&&(t.chains.current[c]=t.chains.current[c].filter(([m])=>m!==d)),t==null||t.chains.current[c].push([d,new Promise(m=>{s.current.push(m)})]),t==null||t.chains.current[c].push([d,new Promise(m=>{Promise.all(f.current[c].map(([C,P])=>P)).then(()=>m())})]),c==="enter"?p.current=p.current.then(()=>t==null?void 0:t.wait.current).then(()=>v(c)):v(c)}),g=F((d,c,v)=>{Promise.all(f.current[c].splice(0).map(([m,C])=>C)).then(()=>{var m;(m=s.current.shift())==null||m()}).then(()=>v(c))});return i.useMemo(()=>({children:r,register:o,unregister:u,onStart:h,onStop:g,wait:p,chains:f}),[o,u,r,h,g,f,p])}let Ee=i.Fragment,Ce=fe.RenderStrategy;function Be(e,t){var n,r;let{transition:l=!0,beforeEnter:a,afterEnter:u,beforeLeave:o,afterLeave:s,enter:p,enterFrom:f,enterTo:h,entered:g,leave:d,leaveFrom:c,leaveTo:v,...m}=e,[C,P]=i.useState(null),b=i.useRef(null),$=be(e),we=he(...$?[b,t,P]:t===null?[]:[t]),ee=(n=m.unmount)==null||n?S.Unmount:S.Hidden,{show:w,appear:te,initial:ne}=We(),[T,X]=i.useState(w?"visible":"hidden"),re=Xe(),{register:k,unregister:x}=re;O(()=>k(b),[k,b]),O(()=>{if(ee===S.Hidden&&b.current){if(w&&T!=="visible"){X("visible");return}return q(T,{hidden:()=>x(b),visible:()=>k(b)})}},[T,b,k,x,w,ee]);let B=ge();O(()=>{if($&&B&&T==="visible"&&b.current===null)throw new Error("Did you forget to passthrough the `ref` to the actual DOM node?")},[b,T,B,$]);let Fe=ne&&!te,le=te&&w&&ne,K=i.useRef(!1),H=ye(()=>{K.current||(X("hidden"),x(b))},re),ie=F(Y=>{K.current=!0;let L=Y?"enter":"leave";H.onStart(b,L,R=>{R==="enter"?a==null||a():R==="leave"&&(o==null||o())})}),se=F(Y=>{let L=Y?"enter":"leave";K.current=!1,H.onStop(b,L,R=>{R==="enter"?u==null||u():R==="leave"&&(s==null||s())}),L==="leave"&&!W(H)&&(X("hidden"),x(b))});i.useEffect(()=>{$&&l||(ie(w),se(w))},[w,$,l]);let Te=!(!l||!$||!B||Fe),[,y]=Le(Te,C,w,{start:ie,end:se}),Se=j({ref:we,className:((r=G(m.className,le&&p,le&&f,y.enter&&p,y.enter&&y.closed&&f,y.enter&&!y.closed&&h,y.leave&&d,y.leave&&!y.closed&&c,y.leave&&y.closed&&v,!y.transition&&w&&g))==null?void 0:r.trim())||void 0,...He(y)}),N=0;return T==="visible"&&(N|=A.Open),T==="hidden"&&(N|=A.Closed),y.enter&&(N|=A.Opening),y.leave&&(N|=A.Closing),E.createElement(V.Provider,{value:H},E.createElement(qe,{value:N},de({ourProps:Se,theirProps:m,defaultTag:Ee,features:Ce,visible:T==="visible",name:"Transition.Child"})))}function Ke(e,t){let{show:n,appear:r=!1,unmount:l=!0,...a}=e,u=i.useRef(null),o=be(e),s=he(...o?[u,t]:t===null?[]:[t]);ge();let p=ve();if(n===void 0&&p!==null&&(n=(p&A.Open)===A.Open),n===void 0)throw new Error("A <Transition /> is used but it is missing a `show={true | false}` prop.");let[f,h]=i.useState(n?"visible":"hidden"),g=ye(()=>{n||h("hidden")}),[d,c]=i.useState(!0),v=i.useRef([n]);O(()=>{d!==!1&&v.current[v.current.length-1]!==n&&(v.current.push(n),c(!1))},[v,n]);let m=i.useMemo(()=>({show:n,appear:r,initial:d}),[n,r,d]);O(()=>{n?h("visible"):!W(g)&&u.current!==null&&h("hidden")},[n,g]);let C={unmount:l},P=F(()=>{var $;d&&c(!1),($=e.beforeEnter)==null||$.call(e)}),b=F(()=>{var $;d&&c(!1),($=e.beforeLeave)==null||$.call(e)});return E.createElement(V.Provider,{value:g},E.createElement(D.Provider,{value:m},de({ourProps:{...C,as:i.Fragment,children:E.createElement($e,{ref:s,...C,...a,beforeEnter:P,beforeLeave:b})},theirProps:{},defaultTag:i.Fragment,features:Ce,visible:f==="visible",name:"Transition"})))}function Ye(e,t){let n=i.useContext(D)!==null,r=ve()!==null;return E.createElement(E.Fragment,null,!n&&r?E.createElement(Q,{ref:t,...e}):E.createElement($e,{ref:t,...e}))}let Q=J(Ke),$e=J(Be),Ze=J(Ye),et=Object.assign(Q,{Child:Ze,Root:Q});export{de as H,Ze as L,fe as M,Qe as T,J as W,et as X,I as a,ce as b,ve as c,Je as d,De as f,A as i,ge as l,O as n,F as o,ue as p,U as s,Pe as t,q as u,he as y};
