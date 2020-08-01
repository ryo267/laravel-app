<template>
</template>

<script>
const THREE = require("three");
const OrbitControls = require("three-orbitcontrols");
//import { OBJLoader } from "three/examples/jsm/loaders/OBJLoader";
import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader.js";
import {
    CSS3DRenderer,
    CSS3DObject,
    CSS3DSprite
} from "three/examples/jsm/renderers/CSS3DRenderer.js";
const fontJson = require("three/examples/fonts/helvetiker_regular.typeface.json");

// or all tools are exported from the "all" file (excluding bonus plugins):
//import { gsap, ScrollTrigger, Draggable, MotionPathPlugin } from "gsap/all";
import { TimelineMax } from "gsap/all";
// don't forget to register plugins
//gsap.registerPlugin(ScrollTrigger, Draggable, MotionPathPlugin);

const DEBUG = false;

const canvas = document.getElementById("canvas"); // canvas要素の取得

const width = window.innerWidth;
const height = window.innerHeight;
const fov = 60;
const fovRad = (fov / 2) * (Math.PI / 180); // 視野角をラジアンに変換
const dist = height / 2 / Math.tan(fovRad); // ウィンドウぴったりのカメラ距離

let camera, scene, renderer;
let mouse = new THREE.Vector2(0, 0);
const group = new THREE.Group(); 
let scroll_y = window.scrollY;
let mixers = [];
const timeline = new TimelineMax();
const clock = new THREE.Clock();
const flactal = new THREE.PointsMaterial({
    map: new THREE.TextureLoader().load("/texture/fractal-2573310_640.jpg"),
    // 色
    color: 0x2196f3,
    // 一つ一つのサイズ
    size: 1,
    blending: THREE.AdditiveBlending, // ブレンドモード
    transparent: true, // 透過true
    depthTest: false // 物体が重なった時に後ろにあるものを描画するかしないか
});

const modelInfoSet = [
    {
        name: "earth",
        scale: 10,
        position: [0, 0, 0],
        material: flactal,
        vector3: false,
        url: "/model/earth_hologram/scene.gltf"
    }
];

export default {
    name: "welcome-component",
    data: function() {
        return {
            user: [],
            users: [],
            posts: [],
            posts_count: [],
            follow: [],
            follow_count: [],
            follower: [],
            follower_count: [],
            favo_count: [],
            comment_count: [],
            thanks_count: [],
            skills: [],
            progresses: [],
            skill_name: "",
            progress: "",
            isActive: false,
            rot: 0,
            objects: [],
            target_2: [
                {
                    name: "company_login",
                    href: "/company/login"
                },
                {
                    name: "company_register",
                    href: "/company/register"
                },
                {
                    name: "user_login",
                    href: "/login"
                },
                {
                    name: "user_register",
                    href: "/register"
                }
            ],
        };
    },
    methods: {
        async getProfile() {
            try {
                const url = "/ajax/user";
                await axios.get(url).then(response => {
                    this.user = response.data[0];
                    this.posts = response.data[1];
                    this.posts_count = response.data[2];
                    this.follow = response.data[3];
                    this.follow_count = response.data[4];
                    this.follower = response.data[5];
                    this.follower_count = response.data[6];
                    this.thanks_count = response.data[7];
                });
            } catch (error) {
                console.log(error);
            }
        },
        async getUsers() {
            try {
                const url = "/ajax/users";
                await axios.get(url).then(response => {
                    this.users = response.data;
                    this.giometries();
                });
                console.log(this.users);
            } catch (error) {
                console.log(error);
            }
        },
        getSkill() {
            const url = "/ajax/user/skill";
            axios.get(url).then(response => {
                this.progresses = response.data;
            });
        },
        animate() {
            requestAnimationFrame(this.animate);
            //Animation Mixerを実行
            if (mixers.length > 0) {
                for (let i = 0; i < mixers.length; i++) {
                    let mixer = mixers[i];
                    mixer.update(clock.getDelta());
                }
            }
            
            this.rot += 0.1;

            // ラジアンに変換する
            const radian = (this.rot * Math.PI) / 180;

            group.rotation.y += 0.01;

            for( let i=0; i<group.length; i++){
                group[i].lookAt(new THREE.Vector3(camera.position.x, camera.position.y, camera.position.z));
            }

            renderer.render(scene, camera);
        },
        onResize() {
            window.addEventListener("resize", function() {
                // レンダラーのサイズを調整する
                //renderer.setPixelRatio(window.devicePixelRatio);
                renderer.setSize(canvas.clientWidth, canvas.clientHeight);

                // カメラのアスペクト比を正す
                camera.aspect = width / height;
                camera.updateProjectionMatrix();
            });
        },
        getVector3(object, material, scale) {
            if (object.geometry == undefined) {
                console.log("undefiend");
                for (let i = 0; i < object.children.length; i++) {
                    getVector3(object.children[i]);
                }
                return;
            } else {
                console.log("defiend");
                const geometry = new THREE.Geometry();
                // 配置する範囲
                const SIZE = scale;
                for (
                    let i = 0;
                    i < object.geometry.attributes.position.array.length;
                    i += 3
                ) {
                    geometry.vertices.push(
                        new THREE.Vector3(
                            SIZE *
                                object.geometry.attributes.position.array[
                                    i + 0
                                ],
                            SIZE *
                                object.geometry.attributes.position.array[
                                    i + 2
                                ],
                            SIZE *
                                object.geometry.attributes.position.array[i + 1]
                        )
                    );
                }
                const mesh = new THREE.Points(geometry, material);
                scene.add(mesh);
                return;
            }
        },
        setMaterial(object, material) {
            if (object.material == undefined) {
                if (DEBUG) console.log("setMaterial");
                for (let i = 0; i < object.children.length; i++) {
                    this.setMaterial(object.children[i], material);
                }
                return;
            } else {
                if (DEBUG) console.log("setMaterial");
                //object.material.colorWrite = false;
                var texture = new THREE.TextureLoader().load(
                    "/texture/fractal-2573310_640.jpg"
                );
                object.material = material;
                return;
            }
        },
        loadModel(json) {
            var loader = new GLTFLoader();
            for (let i = 0; i < json.length; i++) {
                let model = json[i];
                let url = model.url;
                let scale = model.scale;
                let material = model.material;
                let texture = model.texture;
                let vector3 = model.vector3;
                loader.load(
                    url,
                    function(data) {
                        console.log(data);
                        const gltf = data;
                        const object = gltf.scene;
                        object.scale.set(scale, scale, scale);
                        object.position.set(
                            model.position[0],
                            model.position[1],
                            model.position[2]
                        );
                        const animations = gltf.animations;

                        if (animations && animations.length) {
                            //Animation Mixerインスタンスを生成
                            let mixer = new THREE.AnimationMixer(object);

                            //全てのAnimation Clipに対して
                            for (let i = 0; i < animations.length; i++) {
                                let animation = animations[i];

                                //Animation Actionを生成
                                let action = mixer.clipAction(animation);

                                //ループ設定（1回のみ）
                                //action.setLoop(THREE.LoopOnce);

                                //アニメーションの最後のフレームでアニメーションが終了
                                //action.clampWhenFinished = true;

                                //アニメーションを再生
                                action.play();
                            }

                            mixers.push(mixer);
                        }

                        if (material) {
                            if (texture) {
                                this.setTexture(material, texture);
                            }
                            //this.setMaterial(object, material);
                        }
                        if (model.Shadow) {
                            if (DEBUG) console.log("castShadow");
                            model.castShadow = true;
                        }
                        if (vector3) this.getVector3(object, material, scale);
                        if (DEBUG) console.log(object);
                        scene.add(object);
                    },
                    undefined,
                    function(error) {
                        console.error(error);
                    }
                );
            }
        },
        setTexture(material, texture) {
            if (DEBUG) console.log("setTexture");
            var tex = new THREE.TextureLoader().load(texture);
            material.map = tex;
        },
        cameraControl() {
            const controls = new OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.dampingFactor = 0.25;
            controls.enableZoom = true;
        },
        rightConfig() {
            // 平行光源を作成
            // new THREE.DirectionalLight(色, 光の強さ)
            var dirLight = new THREE.DirectionalLight(0xffffff, 1);
            dirLight.castShadow = true;
            scene.add(dirLight);

            // 照明を作成
            const spotLight = new THREE.SpotLight(0xffffff);
            //potLight.position.set(100, 1000, 100);
            spotLight.position.set(
                camera.position.x,
                camera.position.y + 10,
                camera.position.z
            );
            spotLight.lookAt(new THREE.Vector3(0, 0, 0));

            spotLight.castShadow = true;

            spotLight.shadow.mapSize.width = 1024;
            spotLight.shadow.mapSize.height = 1024;

            spotLight.shadow.camera.near = 500;
            spotLight.shadow.camera.far = 4000;
            spotLight.shadow.camera.fov = 30;

            scene.add(spotLight);
        },
        mouseEvent() {
            window.addEventListener("mousemove", e => {
                mouse.x = e.clientX - width / 2; // 原点を中心に持ってくる
                mouse.y = -e.clientY + height / 2; // 軸を反転して原点を中心に持ってくる

                camera.position.set(mouse.x, mouse.y, dist);
            });
        },
        cameraConfig() {
            // カメラを作成 (視野角, 画面のアスペクト比, カメラに映る最短距離, カメラに映る最遠距離)
            camera = new THREE.PerspectiveCamera(
                fov,
                width / height,
                1,
                dist * 2
            );
            camera.position.z = dist; // カメラを遠ざける
            camera.lookAt(new THREE.Vector3(0, 0, 0));
        },
        cameraInit() {
            timeline.to(camera.position, 0.5, {
                x: 0,
                y: 0
            });
        },
        renderConfig() {
            scene = new THREE.Scene();
            //scene.background = new THREE.Color(0xa0a0a0);
            //scene.fog = new THREE.Fog(0xa0a0a0, 10, 250);

            //renderer = new THREE.WebGLRenderer();
            renderer = new CSS3DRenderer();
            //renderer.setPixelRatio(window.devicePixelRatio);
            renderer.setSize(canvas.clientWidth, canvas.clientHeight); // レンダラーのサイズをdivのサイズに設定
            // レンダラー：シャドウを有効にする
            //renderer.shadowMap.enabled = true;
            canvas.appendChild(renderer.domElement);

            //読み込んだシーンが暗いので、明るくする
            renderer.outputEncoding = THREE.GammaEncoding;
        },
        giometries() {

            console.log('users.foreach');
            this.users.forEach(user => {
                var element = document.createElement("div");
                element.className = "user";
                if(user.profile_image != null){
                    element.style.background = "url( " + user.profile_image + " ) center/cover no-repeat";
                }else {
                    element.style.background = "url( /storage/user.png ) center/cover no-repeat";
                }

                //生成したDOM要素をthree.jsで扱えるようなオブジェクトとして登録
                //初期位置をランダム配置
                var object = new CSS3DObject(element);
                object.position.x = Math.random() * 4000 - 2000;
                object.position.y = Math.random() * 4000 - 2000;
                object.position.z = Math.random() * 4000 - 2000;

                //シーンに追加してオブジェクトをまとめた配列に格納。
                group.add(object);

            });
            scene.add(group);

            if (DEBUG) {
                var axis = new THREE.AxisHelper(100); // 長さ100の軸オブジェクトを生成
                scene.add(axis); // シーンにオブジェクトを追加
            }
        },
        movieConfig() {
            // videoエレメント作成
            var video = document.createElement("video");
            // テクスチャにする動画の指定
            video.src = "/movie/Welcome - 24829.mp4";
            // 動画をループ再生
            video.loop = true;
            // 動画のロード＆再生
            video.crossOrigin = "anonymous";
            video.muted = true;
            video.autoplay = true;
            video.play();

            console.log(video);

            // 動画テクスチャ作成
            var movie_texture = new THREE.VideoTexture(video);
            // 1テクセルが1ピクセルより大きな範囲をカバーするときのテクスチャサンプリング方法の指定
            movie_texture.magFilter = THREE.LinearFilter;
            // 1テクセルが1ピクセルより小さな範囲をカバーするときのテクスチャサンプリング方法の指定
            movie_texture.minFilter = THREE.LinearFilter;
            // 動画テクスチャフォーマットの指定
            movie_texture.format = THREE.RGBFormat;

            console.log(movie_texture);

            // マテリアルの作成
            const movie_material = new THREE.MeshBasicMaterial({
                map: movie_texture
            });

            // ジオメトリの作成
            var geometry = new THREE.BoxGeometry(2000, 2000, 0.1);

            // オブジェクトの作成
            const movie_box = new THREE.Mesh(geometry, movie_material);
            scene.add(movie_box);
        },
        init() {
            this.cameraConfig();

            this.renderConfig();

            this.rightConfig();

            if (DEBUG) this.cameraControl();

            //this.movieConfig();

            //this.loadModel(modelInfoSet);
        }
    },
    mounted() {
        this.getUsers();
        this.init();
        this.animate();
        this.onResize();
        if(!DEBUG)this.mouseEvent();
    }
};
</script>
