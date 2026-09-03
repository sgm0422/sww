<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = '文章管理';
    protected static ?string $modelLabel = '文章';
    protected static ?string $pluralModelLabel = '文章';
    protected static ?string $navigationGroup = '内容管理';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('基本信息')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('标题')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state): void {
                                if (blank($get('slug'))) {
                                    $base = Str::slug($state) ?: 'article';
                                    $set('slug', $base.'-'.Str::lower(Str::random(6)));
                                }
                            })
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('slug')
                            ->label('链接别名（URL 后缀）')
                            ->required()
                            ->maxLength(255)
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->helperText('英文、数字或短横线，例如 qubao-houshen'),
                        Forms\Components\Select::make('category_id')
                            ->label('分类')
                            ->relationship('category', 'name')
                            ->preload()
                            ->nullable(),
                        Forms\Components\FileUpload::make('cover_image')
                            ->label('封面图（可选）')
                            ->image()
                            ->directory('articles/covers')
                            ->disk('public'),
                        Forms\Components\Toggle::make('is_published')
                            ->label('发布')
                            ->default(false)
                            ->helperText('关闭时前台不可见'),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('发布时间')
                            ->default(now()),
                        Forms\Components\Textarea::make('excerpt')
                            ->label('摘要')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('正文')
                    ->schema([
                        Forms\Components\RichEditor::make('body')
                            ->label('正文')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('封面')
                    ->disk('public')
                    ->height(36)
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->label('标题')
                    ->searchable()
                    ->limit(50)
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('分类')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('已发布')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('发布时间')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('创建时间')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('分类')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('发布状态'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
