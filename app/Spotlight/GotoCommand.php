<?php

namespace App\Spotlight;

use Illuminate\Support\Str;
use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class GotoCommand extends SpotlightCommand
{
    /**
     * This is the name of the command that will be shown in the Spotlight component.
     */
    protected string $name = 'Go To command';

    /**
     * This is the description of your command which will be shown besides the command name.
     */
    protected string $description = 'Redirect to the given route';

    /**
     * You can define any number of additional search terms (also known as synonyms)
     * to be used when searching for this command.
     */
    protected array $synonyms = [];

    /**
     * Defining dependencies is optional. If you don't have any dependencies you can remove this method.
     * Dependencies are asked from your user in the order you add the dependencies.
     */
    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
            ->add(
                SpotlightCommandDependency::make('route')
                ->setPlaceholder('Where do you want to go?')
            );
    }

    /**
     * Spotlight will resolve dependencies by calling the search method followed by your dependency name.
     * The method will receive the search query as the parameter.
     */
    public function searchRoute($query)
    {
        $routes = collect([
            [
                'id' => route('dashboard'),
                'name' => Str::of('home'),
                'description' => 'Go to home page'
            ],
            [
                'id' => route('archived'),
                'name' => Str::of('archived'),
                'description' => 'Get the Archived list'
            ],
            [
                'id' => route('hidden'),
                'name' => Str::of('hidden'),
                'description' => 'See the list of hidden markers'
            ],
            [
                'id' => route('tags'),
                'name' => Str::of('tags'),
                'description' => 'Get all the tags'
            ],
        ])->sortBy('name');

        return $routes->each(function ($route) {
            return new SpotlightSearchResult(
                $route['id'],
                $route['name'],
                $route['description'],
            );
        });
    }

    /**
     * When all dependencies have been resolved the execute method is called.
     * You can type-hint all resolved dependency you defined earlier.
     */
    public function execute(Spotlight $spotlight, array $route): void
    {
        if (empty($route)) {
            return;
        }

        $spotlight->redirectRoute($route['id']);
    }

    /**
     * You can provide any custom logic you want to determine whether the
     * command will be shown in the Spotlight component. If you don't have any
     * logic you can remove this method. You can type-hint any dependencies you
     * need and they will be resolved from the container.
     */
    public function shouldBeShown(): bool
    {
        return true;
    }
}
