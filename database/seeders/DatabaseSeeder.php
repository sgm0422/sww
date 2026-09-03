<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => '网站管理员',
                'password' => Hash::make('admin123456'),
            ]
        );

        $categories = [
            ['slug' => 'xingshi-bianhu', 'name' => '刑事辩护实务', 'description' => '取保候审、会见、阅卷、庭审辩护等实务经验分享。'],
            ['slug' => 'falv-pinglun', 'name' => '法律评论', 'description' => '对热点法律问题与司法解释的观察与评论。'],
            ['slug' => 'banan-suibi', 'name' => '办案随笔', 'description' => '律师办案过程中的思考与随笔。'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }

        $articles = [
            [
                'slug' => 'qubao-houshen-changjian-wenti',
                'title' => '刑事案件中申请取保候审的几个常见问题',
                'category' => 'xingshi-bianhu',
                'excerpt' => '取保候审是常见问题，但“能不能取保”取决于具体案情与强制措施条件，本文介绍基本概念与常见误区。',
                'body' => '<h2>什么是取保候审</h2><p>取保候审是刑事诉讼中的一种强制措施，由犯罪嫌疑人、被告人提供保证人或者交纳保证金，保证随传随到，并不等于案件终结，也不代表“没事了”。</p><h2>常见的误区</h2><ul><li>误区一：家属认为交了保证金就能“销案”。取保候审只是变更强制措施，侦查、起诉和审判程序仍会继续。</li><li>误区二：只要愿意多交钱就能取保。是否取保由办案机关依法审查，主要看社会危险性、能否保证诉讼等条件。</li><li>误区三：取保后就可以随意离开居住地。未经执行机关批准不得离开所居住的市、县。</li></ul><h2>建议</h2><p>每个案件情况不同，是否申请取保、采用保证人还是保证金、何时提出申请，建议由熟悉案情的律师结合具体证据和程序阶段判断。</p>',
                'published_at' => now()->subDays(5),
            ],
            [
                'slug' => 'shouci-shou-dajubu-tongzhi',
                'title' => '家属第一次收到拘留通知书，应该怎么办',
                'category' => 'banan-suibi',
                'excerpt' => '收到拘留通知书后，家属往往焦虑且不知道能做什么。本文提示几个应当注意的步骤。',
                'body' => '<h2>先核实信息</h2><p>确认通知书上的办案单位、罪名、羁押场所与办案人信息，注意防范冒充公检法实施的诈骗，涉及转账、汇款的要求一律不要轻信。</p><h2>可以做的事</h2><ul><li>尽快向办案单位确认基本程序信息，同时保存好通知书原件或照片。</li><li>为在押人员准备换洗衣物、生活用品，了解看守所寄送物品与存款的规定。</li><li>及时联系专业律师，依法办理委托手续，由律师到看守所会见。</li></ul><h2>不要做的事</h2><p>不要试图“找关系”运作案件，不要轻信能保证放人、保证结果的承诺。刑事案件应当通过合法程序解决。</p>',
                'published_at' => now()->subDays(3),
            ],
            [
                'slug' => 'lvshi-huijian-yi-zhuyi',
                'title' => '律师会见在押犯罪嫌疑人时要注意什么',
                'category' => 'xingshi-bianhu',
                'excerpt' => '会见是刑事辩护的基础工作，既关系到事实了解，也关系到当事人权利的告知与沟通。',
                'body' => '<h2>会见前的准备</h2><p>会见前应当取得合法的委托手续，并提前了解涉嫌罪名、羁押场所及会见要求，准备好需要当事人确认的事项清单。</p><h2>会见中的工作</h2><ul><li>核实身份，告知当事人诉讼权利与律师工作内容。</li><li>认真听取当事人对案情的陈述，客观记录，不诱导、不承诺。</li><li>解答法律问题，告知认罪认罚、申诉等程序的含义和后果。</li></ul><h2>会见后</h2><p>会见记录应当妥善保存，涉及当事人隐私与案件信息的材料依法保密；需要向家属转达的内容应当征得当事人同意。</p>',
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($articles as $article) {
            $categoryId = Category::where('slug', $article['category'])->value('id');
            $data = array_diff_key($article, array_flip(['category']));

            Article::updateOrCreate(
                ['slug' => $article['slug']],
                array_merge($data, [
                    'category_id' => $categoryId,
                    'cover_image' => null,
                    'is_published' => true,
                    'published_at' => $article['published_at'],
                ])
            );
        }
    }
}
