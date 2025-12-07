<?php

use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Vite as ViteFacade;

if (!function_exists('getCurrentVersion')) {
    function getCurrentVersion()
    {
        return app('cache')->remember('current_git_version', 1440, function () {
            $version = trim(exec("git branch | grep '\*' | awk '{if ($2 == \"(HEAD\") print $5; else print $2}' | tr -d '()'"));
            return $version ?: null;
        });
    }
}

if (!function_exists('getLatestVersion')) {
    function getLatestVersion()
    {
        return app('cache')->remember('latest_git_version', 1440, function () {
            $currentVersion = getCurrentVersion();
            $version = trim(exec("git describe --tags --exact-match 2> /dev/null"));

            if (version_compare($currentVersion, $version) < 0) {
                return $version ?: null;
            }

            return null;
        });
    }
}

if (!function_exists('theme_view')) {
    function theme_view(string $view, array $data = []): \Illuminate\View\View
    {

    }
}


if (!function_exists('module_path')) {
    function module_path($name, $path = '')
    {
        $module = app()->basePath('/Modules/' . $name);
        return str_replace('//', '/', $module . ($path ? DIRECTORY_SEPARATOR . $path : $path));

        // $module = app('modules')->find($name);
        // return $module->getPath() . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format = "Y/m/d")
    {
        if (empty($date)) {
            return null;
        }
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($date, $format = "Y/m/d H:i")
    {
        if (empty($date)) {
            return null;
        }
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('formatMoney')) {
    function formatMoney($amount, $currencySymbol = null)
    {
        if (empty($amount)) {
            return null;
        }
        return number_format($amount, 2) . ' ' . currencySymbol($currencySymbol);
    }
}


if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param string $path
     * @return string
     */
    function public_path($path = '')
    {
        return app()->make('path.public') . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}

if (!function_exists('module_vite')) {
    /**
     * support for vite
     */
    function module_vite($module, $asset): Vite
    {
        return ViteFacade::useHotFile(storage_path('vite.hot'))->useBuildDirectory($module)->withEntryPoints([$asset]);
    }
}

if (!function_exists('getArrayKeys')) {
    function getArrayKeys($arr, $except = null)
    {
        $arr = array_keys($arr);
        if ($except !== null) $arr = Illuminate\Support\Arr::except($arr, $except);
        return $arr;
    }
}

if (!function_exists('viewToDatatable')) {
    function viewToDatatable($html, $result, array $extra = [])
    {
        // Initialize an empty array to store table data
        $data = [];

        if ($html != '') {

            // Load HTML string into a DOMDocument
            $doc = new DOMDocument();
            $doc->loadHTML('<?xml encoding="UTF-8">' . $html);

            // Iterate through each table row
            foreach ($doc->getElementsByTagName('tr') as $row) {
                // Initialize an empty array to store cell data for each row
                $rowData = [];

                // Iterate through each table cell in the current row
                foreach ($row->getElementsByTagName('td') as $cell) {
                    // Add cell content to the row data array
                    $columnName = $cell->getAttribute('data-column');
                    $rowData[$columnName] = $doc->saveHTML($cell);
                }

                // Add row data to the table data array
                $data[] = (object)$rowData;
            }
        }

        $isPaginated = false;
        if ($result instanceof \Illuminate\Pagination\LengthAwarePaginator || $result instanceof \Illuminate\Pagination\Paginator) {
            $isPaginated = true;
        }

        return [
            'data' => $data,
            'draw' => request('draw', 0) + 1,
            'currentPage' => $isPaginated ? $result->currentPage() : 0,
            'last_page' => $isPaginated ? $result->lastPage() : 0,
            //'draw'              => $result->firstItem(),
            'recordsPerPage' => $isPaginated ? $result->perPage() : 0,
            "recordsTotal" => $isPaginated ? ($result->lastItem() ?? 0) : 0,
            "recordsFiltered" => $isPaginated ? $result->total() : $result->count(),
            ...$extra
        ];
    }
}
